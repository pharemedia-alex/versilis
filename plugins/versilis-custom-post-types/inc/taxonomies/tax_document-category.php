<?php

/**
 * Registers the Custom Post Type hooks.
 * @since 1.0.0
 * @uses add_action()
 */

add_action( 'init' ,'register_tax_document_category');

/**
 * Creates a custom taxonomy team
 * @since 1.0.0
 * @uses register_post_type()
 */

function register_tax_document_category() {

	$cpt = array(
		'document'
	);
	
	$labels = array(
		'name' => _x( 'Document categories', 'taxonomy general name', 'versilis-cc' ),
		'singular_name' => _x( 'Document category', 'taxonomy singular name', 'versilis-cc' ),
		'search_items' =>  __( 'Search for a document category', 'versilis-cc' ),
		'all_items' => __( 'All Document categories', 'versilis-cc' ),
		'parent_item' => __( 'Parent Document category', 'versilis-cc' ),
		'parent_item_colon' => __( 'Parent document category:', 'versilis-cc' ),
		'edit_item' => __( 'Edit document category', 'versilis-cc' ), 
		'update_item' => __( 'Update document category', 'versilis-cc' ),
		'add_new_item' => __( 'Add a new document category', 'versilis-cc' ),
		'new_item_name' => __( 'New document category', 'versilis-cc' ),
		'menu_name' => __( 'Categories', 'versilis-cc' )
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

	register_taxonomy('document-category', $cpt , $args);
}