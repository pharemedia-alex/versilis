<?php

/**
 * Registers general options page
 * @since 1.0.0
 * @uses add_action()
 */

//Add option page 
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> __( 'Theme options', 'banq-ntni-cc' ),
		'menu_title'	=> 'Theme options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	//create sub menu option page
	/*acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));*/
	
}