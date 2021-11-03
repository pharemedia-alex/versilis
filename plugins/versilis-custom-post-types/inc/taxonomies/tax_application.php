<?php

/**
 * Registers the Custom Post Type hooks.
 * @since 1.0.0
 * @uses add_action()
 */

add_action( 'init' ,'register_tax_application');

/**
 * Creates a custom taxonomy team
 * @since 1.0.0
 * @uses register_post_type()
 */

function register_tax_application() {

	$cpt = array(
		'product',
		'case-study'
	);
	
	$labels = array(
		'name' => _x( 'Applications', 'taxonomy general name', 'versilis-cc' ),
		'singular_name' => _x( 'Application', 'taxonomy singular name', 'versilis-cc' ),
		'search_items' =>  __( 'Search for an application', 'versilis-cc' ),
		'all_items' => __( 'All Applications', 'versilis-cc' ),
		'parent_item' => __( 'Parent Application', 'versilis-cc' ),
		'parent_item_colon' => __( 'Parent application:', 'versilis-cc' ),
		'edit_item' => __( 'Edit Application', 'versilis-cc' ), 
		'update_item' => __( 'Update Application', 'versilis-cc' ),
		'add_new_item' => __( 'Add a new Application', 'versilis-cc' ),
		'new_item_name' => __( 'New Application', 'versilis-cc' ),
		'menu_name' => __( 'Applications', 'versilis-cc' )
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => false,
		//'rewrite' => array( 'slug' => 'my-slug' ),
	);

	register_taxonomy('application', $cpt , $args);
}