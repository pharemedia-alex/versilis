<?php

/**
 * Registers general options page
 * @since 1.0.0
 * @uses add_action()
 */

//Add option page 
if( function_exists('acf_add_options_page') ) {
	
	// Add parent.
	$parent = acf_add_options_page(array(
		'page_title'  => __('Theme options'),
		'menu_title'  => __('Theme options'),
		'redirect'    => true,
));

	// Add sub page.
	$child = acf_add_options_sub_page(array(
			'page_title'  => __('General settings'),
			'menu_title'  => __('General settings'),
			'parent_slug' => $parent['menu_slug'],
	));

	// Add sub page.
	$child = acf_add_options_sub_page(array(
		'page_title'  => __('Mega menu'),
		'menu_title'  => __('Mega menu'),
		'parent_slug' => $parent['menu_slug'],
));

	//create sub menu option page
	/*acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));*/
	
}