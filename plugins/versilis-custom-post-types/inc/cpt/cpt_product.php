<?php

/**
 * Registers the Custom Post Type hooks.
 * @since 1.0.0
 * @uses add_action()
 */

add_action( 'init' ,'register_cpt_product');

/**
 * Creates a custom post type for client stories
 * @since 1.0.0
 * @uses register_post_type()
 */

function register_cpt_product() {

	$labels = array(
		'name'               => _x( "Products", 'post type general name', 'versilis-cc' ),
		'singular_name'      => _x( "Product", 'post type singular name', 'versilis-cc' ),
		'menu_name'          => _x( "Products", 'admin menu', 'versilis-cc' ),
		'name_admin_bar'     => _x( "Product", 'add new on admin bar', 'versilis-cc' ),
		'add_new'            => _x( 'Add', 'Custom Post Type', 'versilis-cc' ),
		'add_new_item'       => __( 'Add a new product', 'versilis-cc' ),
		'new_item'           => __( 'New', 'versilis-cc' ),
		'edit_item'          => __( 'Edit', 'versilis-cc' ),
		'view_item'          => __( "View", 'versilis-cc' ),
		'all_items'          => __( 'All Products', 'versilis-cc' ),
		'search_items'       => __( 'Search', 'versilis-cc' ),
		//'parent_item_colon'  => __( 'Parent Client Story:', 'versilis-cc' ),
		'not_found'          => __( "No Product.", 'versilis-cc' ),
		'not_found_in_trash' => __( "No Product in the trash.", 'versilis-cc' )
	);

	$args = array(
		'labels'               => $labels, // An array of labels for this post type. 
		'description'          => __( "Manage products", 'versilis-cc' ), // A short descriptive summary of what the post type is.
		'public'               => true,    // Whether a post type is intended for use publicly either via the admin interface or by front-end users.
		'publicly_queryable'   => true,    // Whether queries can be performed on the front end for the post type as part of parse_request().
		'show_ui'              => true,    // Whether to generate and allow a UI for managing this post type in the admin.
		'show_in_menu'         => true,    // Whether to show this post type in admin menu. 
		'show_in_admin_bar'    => true,    // Whether to make this post available via admin bar.
		'query_var'            => true,    // Triggers the handling of rewrites for this post type.
		'rewrite'              => array('slug' => 'product','with_front' => false),
		'capability_type'      => 'post',  // The string to use to build the read, edit, and delete capabilities.
		'has_archive'          => false,    // Whether there should be post type archives, or if a string, the archive slug to use.
		'hierarchical'         => false,   // Whether the post type is hierarchical (e.g. page).
		'menu_position'        => 31,    // The position in the menu order the post type should appear. default is null, means at the bottom.
		'menu_icon'		       => 'dashicons-media-document',    // The url to the icon to be used for this menu or the name of the icon from the iconfont
		'exclude_from_search'  => true,   // Whether to exclude posts in this post type from fron-end search.
		'supports'             => array( 'title', 'revisions', 'thumbnail' ), // Core feature(s) the post type supports.
		'can_export'           => true,    // Whether to allow this post type to be exported. 
		'delete_with_user'     => false,    // Whether to delete posts of this type when deleting a user. If true, posts of this type belonging to the user will be moved to trash when then user is deleted. If false, posts of this type belonging to the user will *not* be trashed or deleted. 
	);

	register_post_type( 'product', $args ); // Registers the post type.
}
