<?php

/**
 * custom functions specific to the project
 * 
 */
//examples:
//add_filter('acf/load_field', 'msk_acf_disable_field');
//add_filter('acf/load_field/name=annonce_prix_avec_commission', 'msk_acf_disable_field');
//add_filter('acf/load_field/type=password', 'msk_acf_disable_field');
//add_filter('acf/load_field/key=field_5a9af8d5250dd', 'msk_acf_disable_field');

/**
 * Add the colors into Iris
 */
/*function register_acf_custom_color_palette() {
?>
    <script type="text/javascript">
        (function( $ ) {
            acf.add_filter( 'color_picker_args', function( args, $field ){
                // add the hexadecimal codes here for the colors you want to appear as swatches
                args.palettes = ['#03827F', '#FE9E95', '#686868', ''];
                // return colors
                return args;
            });
        })(jQuery);
    </script>
    <?php
}
add_action( 'acf/input/admin_footer', 'register_acf_custom_color_palette');
*/


// Create new toolbar for ACF - should be used to limitate options for the client
// when it's relevant to keep design consistency
add_filter( 'acf/fields/wysiwyg/toolbars' , 'custom_toolbars'  );

function custom_toolbars( $toolbars )
{
	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Very Basic' ] = array();
	$toolbars['Very Basic' ][1] = array(
    'bold',
    'italic',
    'underline',
    'bullist',
    'numlist',
    //'blockquote',
    'pastetext',
    'removeformat',
    'undo',
    'redo',
    'link'
  );

	// Edit the "Full" toolbar and remove 'code'
	// - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}

	// remove the 'Basic' toolbar completely
	//unset( $toolbars['Basic' ] );

	// return $toolbars - IMPORTANT!
	return $toolbars;
}

add_filter('oembed_fetch_url','add_video_args', 10, 3);

function add_video_args($provider, $url, $args) {
    if(is_front_page()) {
        if ( strpos($provider, '//vimeo.com/') !== false ) {
            $args = array(
                'title' => 0,
                'byline' => 0,
                'portrait' => 0,
                'badge' => 0
            );
            $provider = add_query_arg( $args, $provider );
        }
    }
    return $provider;   
}

/**
 * Wrap videos embedded via oEmbed to make them responsive
 */
function custom_wrap_oembed( $html, $url, $attr, $post_id ) {
	return '<div class="video-wrapper">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'custom_wrap_oembed', 99, 4 );

/**
 * Wrap videos embedded via <iframe> or <embed> to make them responsive as well
 */
function custom_wrap_iframe( $content ) {
    // Match any iframes or embeds
    $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
    preg_match_all( $pattern, $content, $matches );
    foreach ( $matches[0] as $match ) {
        $wrappedframe = '<div class="video-wrapper">' . $match . '</div>';
        $content = str_replace($match, $wrappedframe, $content);
    }
    return $content;
}
add_filter( 'the_content', 'custom_wrap_iframe' );

/**
 * Responsive video
 */
function responsive_video($video_content) {
    
    // Use preg_match to find iframe src.
    preg_match('/src="(.+?)"/', $video_content, $matches);
    $src = $matches[1] . '?rel=0';

    // Add extra parameters to src and replace HTML
    $params = array(
        'controls'  => 0,
        'hd'        => 1,
        'autohide'  => 1
    );
    $new_src = add_query_arg($params, $src);
    $video_content = str_replace($src, $new_src, $video_content);

    // Add extra attributes to iframe HTML.
    $attributes = 'frameborder="0"';
    $video_content = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video_content);
    $video_content = '<div class="video-wrapper">' . $video_content . '</div>';

    // Display customized HTML.
    echo $video_content;
}


//remove inline css added by wordpress (admin bar) for user role
add_action('get_header', 
    function () {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }
);

/*
Exceptions for Flexible content modules and templates

Remove Layout based on template or custom post types, for exceptions with shared flexible content field group
disabled on backend only with no impact on front end
the key is the field key for the flex field
the priority is set exceedingly high to ensure it runs last

Indicate all exceptions here - minimize exceptions as much as possible:

layouts             Available for Template(s) only - where flexible content is available on editing screen
------              --------------------------------------------------------------------------------------

*/
//add_filter('acf/load_field/key=field_5e4b64c9dbeb4', 'remove_layouts', 99);

function remove_layouts($field) {
    if (!is_admin() || 'acf-field-group' == get_current_screen()->post_type) {
        // not on front end and not when editing the Flexible Content field itself
        return $field;
    }
  
    $layouts_to_remove = array();

    /*
    if( (get_page_template_slug()!=='yout_template_slug')            
        array_push($layouts_to_remove, 'your_flexible_content_layout');
    }
    */

    /*
    if( get_post_type()!=='your_post_type' ) {
        array_push($layouts_to_remove, 'your_flexible_content_layout');
    }
    */

    if (empty($layouts_to_remove)) {
        return $field;
    }
    
    // move current layouts into a var
    $layouts = $field['layouts'];

    // clear layouts
    $field['layouts'] = array();

    foreach ($layouts as $layout) {
        // check
        if (!in_array($layout['name'], $layouts_to_remove)) {
        // keep this layout
        array_push($field['layouts'], $layout);
        }
    }

    return $field;
} 

//deregister CF7 default stylesheet - custom one available in Frontroots
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
    wp_deregister_style( 'contact-form-7' );
}

//remove auto formatting from contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');

//define image sizes
add_action( 'after_setup_theme', function(){
//add_image_size( 's_team_member', 1250, 830 );
//add_image_size( 'layout_img', 700, 500, array('center', 'top') );
    //add_image_size( 's_thumbnail', 220, 180, false );
});

// Allow SVG upload in backend
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    //global $wp_version;
    /*if ( $wp_version !== '4.7.1' ) {
        return $data;
    }*/

    $filetype = wp_check_filetype( $filename, $mimes );

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4 );

// Allow SVG mime type 
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

// Fix SVG
function fix_svg() {
echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

//Hide WPML meta box
add_action('admin_head', 'disable_icl_metabox',99);
function disable_icl_metabox() {
    global $post;
    remove_meta_box('icl_div_config',$post->posttype,'normal');
}

function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyCi2-xh7rI1qS1hWtHeue4EhQlnCaPpVLU';
	return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/* Save project location after using Google maps */
add_action('acf/save_post', 'save_project_location');
function save_project_location( $post_id ) {

    if ( 'case-study' == get_post_type() ) {

        $project_location_map = get_field('project_location_map', $post_id);
        $project_location .= ( !empty($project_location_map['city']) ) ? $project_location_map['city'] . ', ' : '';
        $project_location .= ( !empty($project_location_map['state_short']) ) ? $project_location_map['state_short'] . ', ' : '';
        $project_location .= ( !empty($project_location_map['country_short']) ) ? $project_location_map['country_short'] : '';

    }
    
    update_field('project_location', $project_location, $post_id);

    $all_locations = (array) json_decode(get_option('case_studies_locations'));
    if($all_locations===NULL) {
        $all_locations = array();
    }
    
    if ( array_search($project_location, $all_locations)===false && $project_location!==null) {
        
        $all_locations[$project_location_map['place_id']] = $project_location;
        update_option('case_studies_locations', json_encode($all_locations));

    }
}

// Number Pagination Function 
function custom_pagination( $max, $current, $url='') {
    
    $big = 9999999; // need an unlikely integer
    if (get_query_var('location'))
    $add_args = array();
    $query_vars = array('location', 'product-id', 'application');
    
    foreach( $query_vars as $var ) {
        if ( isset($_POST[$var]) && !empty($_POST[$var]) ) {
            $add_args[$var] = $_POST[$var];
        }
    }
    
    $fallback_base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
    $base = isset( $url ) ? trailingslashit( $url ) . '%_%' : $fallback_base;

    echo paginate_links( 
        array(
            'base'       => $base,
            'format'     => '?paged=%#%',
            'current'    => $current,
            'total'      => $max,
            'prev_text'  => __('previous page', 'versilis-theme'),
            'next_text'  => __('next page', 'versilis-theme'),
            'add_args'   => $add_args
        )
    );
}

//populate dropdown menu - theme options for highlight in main menu
function acf_load_menu_item_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations['primary_navigation'] );

    $menu_items = wp_get_nav_menu_items($menu->term_id);

    foreach( $menu_items as $key => $menu_item ) {
        if ( !$menu_item->menu_item_parent ) {
            $field['choices'][ $menu_item->ID ] = $menu_item->title;
        }
    }

    // return the field
    return $field;
    
}

add_filter('acf/load_field/key=field_61842ef99a4d3', 'acf_load_menu_item_choices');