<?php

/**
 * Registers the Custom Post Type hooks.
 * @since 1.0.0
 * @uses add_action()
 */

add_action( 'init' ,'register_tax_product_type');

/**
 * Creates a custom taxonomy team
 * @since 1.0.0
 * @uses register_post_type()
 */

function register_tax_product_type() {

	$cpt = array(
		'product'
	);
	
	$labels = array(
		'name' => _x( 'Product types', 'taxonomy general name', 'versilis-cc' ),
		'singular_name' => _x( 'Product type', 'taxonomy singular name', 'versilis-cc' ),
		'search_items' =>  __( 'Search for a product types', 'versilis-cc' ),
		'all_items' => __( 'All Product types', 'versilis-cc' ),
		'parent_item' => __( 'Parent Product type', 'versilis-cc' ),
		'parent_item_colon' => __( 'Parent product type:', 'versilis-cc' ),
		'edit_item' => __( 'Edit Product type', 'versilis-cc' ), 
		'update_item' => __( 'Update Product type', 'versilis-cc' ),
		'add_new_item' => __( 'Add a new Product type', 'versilis-cc' ),
		'new_item_name' => __( 'New Product type', 'versilis-cc' ),
		'menu_name' => __( 'Product types', 'versilis-cc' )
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

	register_taxonomy('product-type', $cpt , $args);
}