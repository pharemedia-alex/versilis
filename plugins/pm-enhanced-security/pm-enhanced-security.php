<?php
/*
Plugin name: PM Enhanced security
Description: Strengthen security in WP: htaccess, disable file editing, remove XML-RPC, etc and improve debug
Author: Phare Media
Author URI: https://pharemedia.com
Version: 1.0
*/

// Accès direct interdit
if ( ! defined( 'ABSPATH' ) ) exit;

function pm_enhanced_security_activate() {
    improve_config(); //modify wp-config.php
    delete_unused_files(); // delete wp-admin/install.php, /wp-config-sample.php
}
register_activation_hook( __FILE__, 'pm_enhanced_security_activate' );

function remove_login_errors(){
    add_filter('login_errors', 'return_noerror');
}
function return_noerror($a){
    return null;
}

function improve_config(){
    
    $config_file = $_SERVER['DOCUMENT_ROOT'] . "/wp-config.php";
    $space = "\r\n";

    try {
        $fh = fopen($config_file, 'a');
    } catch (Exception $e) {
        trigger_error('Exception: ' . $e->getMessage(), E_USER_ERROR);
    }

    $file_content = file($config_file);
    
    $is_disallow_file_edit = false;
    $is_force_ssl_login = false;

    foreach ( $file_content as $line ) {
		if ( ! preg_match( '/^define\(\s*\'([A-Z_]+)\',(.*)\)/', $line, $match ) ) {
			continue;
		}

		if ( 'DISALLOW_FILE_EDIT' === $match[1] ) {
			$is_disallow_file_edit = true;
			$line              = $constant;
        }
        if ( 'FORCE_SSL_LOGIN' === $match[1] ) {
			$is_force_ssl_login = true;
			$line              = $constant;
		}
	}
	unset( $line );

    //test if file already contains security improvements
    if( $is_disallow_file_edit != true ) {
        $stringData = $space . "define('DISALLOW_FILE_EDIT', true );" . $space;
    }

    $website_url = parse_url(get_site_url());

    if( $is_force_ssl_login != true && $website_url['scheme'] == 'https' ) {
        $stringData .= $space . "define('FORCE_SSL_LOGIN', true );" . $space;
    }
        
    try {
        fwrite($fh, $stringData);
        fclose($fh);
    } catch (Exception $e) {
        trigger_error('Exception: ' . $e->getMessage(), E_USER_ERROR);
    }

}

function delete_unused_files(){
    
    $config_sample_file = $_SERVER['DOCUMENT_ROOT'] . '/wp-config-sample.php';
    $install_file = $_SERVER['DOCUMENT_ROOT'] . '/wp-admin/install.php';

    if (file_exists($config_sample_file)) {
        try {
            unlink($config_sample_file);
        } catch (Exception $e) {
            trigger_error('Exception: ' . $e->getMessage(), E_USER_ERROR);
        }
    }

    if (file_exists($install_file)) {
        try {
            unlink($install_file);
        } catch (Exception $e) {
            trigger_error('Exception: ' . $e->getMessage(), E_USER_ERROR);
        }
    }
    
}

function modify_htaccess_security(){
#WP protection
/*
htaccess
<Files wp-config.php>
order allow,deny
deny from all
</Files>

Options All -Indexes
<Files .htaccess>
order allow, deny
deny from all
</Files>
*/  
}

function remove_wp_version(){
    //remove WP version
    remove_action('wp_head', 'wp_generator');
}

function disable_xml_rpc(){
    add_filter('xmlrpc_enabled', '__return_false');
    remove_action('wp_head', 'rsd_link');
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
   }
   add_action( 'init', 'disable_emojis' );
   
   /**
    * Filter function used to remove the tinymce emoji plugin.
    * 
    * @param array $plugins 
    * @return array Difference betwen the two arrays
    */
   function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
    return array();
    }
   }
   
   /**
    * Remove emoji CDN hostname from DNS prefetching hints.
    *
    * @param array $urls URLs to print for resource hints.
    * @param string $relation_type The relation type the URLs are printed for.
    * @return array Difference betwen the two arrays.
    */
   function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
   
   $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
   
   return $urls;
   }

remove_login_errors();
remove_wp_version();
disable_xml_rpc();
