<?php

/**
 * @link              https://versilis.com
 * @since             1.0.0
 * @package           versilis_Cpt
 * @wordpress-plugin
 * Plugin Name:       Versilis website custom content
 * Plugin URI:        https://versilis.com
 * Description:       custom post types, custom taxonomies, custom options and custom roles for versilis website
 * Version:           1.0.0
 * Author:            Alex Bussiere - Phare Media
 * Author URI:        https://pharemedia.com
 * Domain			  versilis-cc
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WP_CPT_VERSION', '1.0.0' );

/**
 * Includes the files containing Custom Post Types code.
 * @since 1.0.0
 * @uses require_once()
 */

require_once( dirname( __FILE__ ) . '/inc/cpt/cpt_case-study.php' );
require_once( dirname( __FILE__ ) . '/inc/cpt/cpt_product.php' );
require_once( dirname( __FILE__ ) . '/inc/cpt/cpt_document.php' );

/**
 * Includes the files containing Custom Taxonomies code.
 * @since 1.0.0
 * @uses require_once()
 */

require_once( dirname( __FILE__ ) . '/inc/taxonomies/tax_application.php' );
require_once( dirname( __FILE__ ) . '/inc/taxonomies/tax_product-type.php' );
require_once( dirname( __FILE__ ) . '/inc/taxonomies/tax_document-category.php' );

/**
 * Includes the files containing Custom Options
 * @since 1.0.0
 * @uses require_once()
 */

require_once( dirname( __FILE__ ) . '/inc/options/general.php' );

/**
 * Includes the files containing Custom Role code.
 * @since 1.0.0
 * @uses require_once()
 */

require_once( dirname( __FILE__ ) . '/inc/user_roles/user_roles.php' );

//Flush rewrite rules
function rewrite_flush() {
    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'rewrite_flush' );
