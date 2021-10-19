<?php

/**
 * Adds Gutenberg blocks to manage content
 * 
 */

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'two-columns-text',
            'title'             => __('Two columns text'),
            'description'       => __('Custom layout of text on two columns.'),
            'render_template'   => 'admin/blocks/two_columns_text.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'layout', 'text' ),
            'supports'		=> [
              'align'			=> false,
              'anchor'		=> true,
              'customClassName'	=> true,
              'jsx' 			=> true,
            ]
        ));
    }
}

/* Layout for case studies */
/*
function myplugin_register_template() {
  $post_type_object = get_post_type_object( 'case-study' );
  $post_type_object->template = array(
    array( 'acf/two-columns-text', array() )
  );
  $post_type_object->template_lock = 'all';
}

add_action( 'init', 'myplugin_register_template' );
*/

?>