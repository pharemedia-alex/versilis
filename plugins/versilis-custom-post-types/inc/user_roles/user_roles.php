<?php

/**
 * Registers the Custom Post Type hooks.
 * @since 1.0.0
 * @uses add_action()
 */

add_action( 'init' ,'add_versilis_admin');

//add_action( 'init' ,'remove_custom_role');
function remove_custom_role() {
	wp_roles()->remove_role( 'client-admin' );
}

/**
 * Creates a custom role for Client admin
 * @since 1.0.0
 * @uses add_role()
 */

function add_versilis_admin () {
	add_role( 
		'client-admin', 
		__( 'Admin client', 'versilis-cc' ), 
		array( 
			'activate_plugins' => false,
			'delete_others_pages' => true,
			'delete_others_posts' => true,
			'delete_pages' => true,
			'delete_posts' => true,
			'delete_private_pages' => true,
			'delete_private_posts' => true,
			'delete_published_pages' => true,
			'delete_published_posts' => true,
			'edit_dashboard' => true,
			'edit_others_pages' => true,
			'edit_others_posts' => true,
			'edit_pages' => true,
			'edit_posts' => true,
			'edit_private_pages' => true,
			'edit_private_posts' => true,
			'edit_published_pages' => true,
			'edit_published_posts' => true,
			'edit_theme_options' => false,
			'export' => false,
			'import' => false,
			'list_users' => true,
			'manage_categories' => true,
			'manage_links' => true,
			'manage_options' => false,
			'moderate_comments' => true,
			'promote_users' => true,
			'publish_pages' => true,
			'publish_posts' => true,
			'read_private_pages' => true,
			'read_private_posts' => true,
			'read' => true,
			'remove_users' => true,
			'switch_themes' => false,
			'upload_files' => true,
			'customize' => false,
			'delete_site' => false,
			'update_core' => false,
			'update_plugins' => false,
			'update_themes' => false,
			'install_plugins' => false,
			'install_themes' => false,
			'delete_themes' => false,
			'delete_plugins' => false,
			'edit_plugins' => false,
			'edit_themes' => false,
			'edit_files' => false,
			'edit_users' => true,
			'add_users' => true,
			'create_users' => true,
			'delete_users' => true,
			'unfiltered_html' => true
		) 
	);
}