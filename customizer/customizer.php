<?php

/**
 * Theme Customizer Boilerplate
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2012, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
 */


/**
 * Arrays of option fields and tabs
 */	
require( get_stylesheet_directory() . '/customizer/get-options.php' );

/**
 * Helper functions
 */	
require( get_stylesheet_directory() . '/customizer/helpers.php' );


/**
 * Adds Customizer Sections, Settings and Controls
 *
 * - Require Custom Customizer Controls
 * - Add Customizer Sections
 * - Add Customizer Controls
 *  -- Add Textarea Control
 *  -- Add Number Control
 *
 * @uses	thsp_get_theme_customizer_sections()	Defined in helpers.php
 * @uses	thsp_settings_page_capability()			Defined in helpers.php
 * @uses	thsp_get_theme_customizer_fields()		Defined in get-options.php
 *
 * @link	$wp_customize->add_section				http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
 * @link	$wp_customize->add_setting				http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
 * @link	$wp_customize->add_control				http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
 */
add_action( 'customize_register', 'thsp_customize_register' );
function thsp_customize_register( $wp_customize ) {

	/**
	 * Create custom controls
	 */	
	require( get_stylesheet_directory() . '/customizer/extend.php' );

	/**
	 * Adds Customizer sections
	 */
	$thsp_sections = thsp_get_theme_customizer_fields();
	foreach( $thsp_sections as $thsp_section_key => $thsp_section_value ) {
		
		/**
		 * Adds Customizer section, if needed
		 */
		if( ! isset( $thsp_section_value['existing_section'] ) ) {
			
			$thsp_section_args = $thsp_section_value['args'];
			
			// Add section
			$wp_customize->add_section(
				$thsp_section_key,
				array(
					'title'			=> $thsp_section_args['title'],
					'description'	=> $thsp_section_args['description'],
					'priority'		=> $thsp_section_args['priority']
				)
			);
			
		} // end if
		
		// Add settings and controls
		$thsp_section_fields = $thsp_section_value['fields'];
		foreach( $thsp_section_fields as $thsp_field_key => $thsp_field_value ) {

			/**
			 * Adds Customizer settings
			 */
			$wp_customize->add_setting(
				"thsp_theme_options[$thsp_field_key]",
				$thsp_field_value['setting_args']
			);

			/**
			 * Adds Customizer control
			 *
			 * First need to add 'section value to it, so it doesn't need to
			 * be repeated in options array for each field
			 */
			$thsp_field_value['control_args']['section'] = $thsp_section_key;
			$wp_customize->add_control(
				"thsp_theme_options[$thsp_field_key]",
				$thsp_field_value['control_args']
			);
				
		} // end foreach
		
	}

}