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
 * @uses	thsp_settings_page_capability()		Defined in helpers.php
 * @uses	thsp_get_theme_customizer_fields()		Defined in get-options.php
 *
 * @link	$wp_customize->add_section			http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
 * @link	$wp_customize->add_setting			http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
 * @link	$wp_customize->add_control			http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
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
	$thsp_sections = thsp_get_theme_customizer_sections();
	foreach( $thsp_sections as $thsp_section ) {
		$wp_customize->add_section(
			$thsp_section['name'],
			array(
				'title'          => $thsp_section['title'],
				'priority'       => 5
			)
		);
	}
	
	$thsp_options = thsp_get_theme_customizer_fields();
	foreach( $thsp_options as $thsp_option_key => $thsp_option_value ) {

		// Make sure option should not be hidden in customizer
		if( !$thsp_option_value['customizer_hide'] ) {
		
			$setting_args = array(
				'capability'	=> thsp_settings_page_capability(),
				'type'			=> 'option'
			);
			
			// Check for default value
			if( isset( $thsp_option_value['default'] ) ) {
				$args['default'] = $thsp_option_value['default'];
			}
			
			/**
			 * Adds Customizer settings
			 */
			$wp_customize->add_setting(
				"thsp_theme_options[$thsp_option_key]",
				$setting_args
			);
	
			
			$control_args = array(
				'label'      => $thsp_option_value['title'],
				'section'    => $thsp_option_value['section'],
				'settings'   => "thsp_theme_options[$thsp_option_key]",
				'type'       => $thsp_option_value['type']
			);
			
			// Check if there's an array of possible values, add it to $args array
			if( isset( $thsp_option_value['options'] ) ) {
				$given_options = array();
				foreach( $thsp_option_value['options'] as $given_option_key => $given_option_value ) {
					$given_options[$given_option_key] = $given_option_value['title'];
				}
				$control_args['choices'] = $given_options;
			}
		
			// Check if it's a textarea control (custom)
			if( 'textarea' == $thsp_option_value['type'] ) {
	
				/**
				 * Adds Customizer textarea control
				 */
				$wp_customize->add_control(
					new Customizer_Textarea_Control(
						$wp_customize,
						"thsp_theme_options[$thsp_option_key]",
						$control_args
					)
				);		
			
			// Check if it's a number control
			} elseif( 'number' == $thsp_option_value['type'] ) {
	
				/**
				 * Adds Customizer input[type=number] control
				 */
				$wp_customize->add_control(
					new Customizer_Number_Control(
						$wp_customize,
						"thsp_theme_options[$thsp_option_key]",
						$control_args
					)
				);		
	
			// All other controls
			} else {
			
				/**
				 * Adds Customizer built-in control
				 */
				$wp_customize->add_control(
					"thsp_theme_options[$thsp_option_key]",
					$control_args
				);
			
			} // end check control type
			
		} // end if
		
	} // end foreach

}