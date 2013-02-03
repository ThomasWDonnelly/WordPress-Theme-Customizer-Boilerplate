<?php

/**
 * Get Theme Options
 *
 * - Theme Options Fields
 * - Theme Options Values
 * - Theme Options Defaults
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2013, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
 */


/**
 * Helper function that holds array of theme options fields.
 *
 * @return	array	$options	Array of setting fields
 */
function thsp_get_theme_customizer_fields() {

	$options = array(

		'colors' => array(
			'existing_section' => true,
			'fields' => array(
			)
		),
		
		'new_section' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'New Section Title', 'my_theme_textdomain' ),
				'description' => __( 'New section description', 'my_theme_textdomain' ),
				'priority' => 10
			),
			'fields' => array(
			)
		)

	);
	
	return $options;
	
}


/**
 * Get Theme Options Values
 * 
 * Array that holds all of the defined values for theme options. If the user 
 * has not specified a value for a given Theme option, then the option's 
 * default value is used instead.
 *
 * @uses	thsp_get_theme_option_defaults()	defined in /inc/theme-options/get-options.php
 * @return	array								Current values for all theme options
 * @since Cazuela 1.0
 */
function thsp_get_theme_options() {

	// Get the option defaults
	$option_defaults = thsp_get_theme_option_defaults();
	
	// Parse the stored options with the defaults
	$thsp_cazuela_options = wp_parse_args( get_option( 'thsp_cazuela_options', array() ), $option_defaults );
	
	// Return the parsed array
	return $thsp_cazuela_options;
	
}


/**
 * Get Theme Options Defaults
 * 
 * Returns an array that holds default values for all theme options.
 * 
 * @uses	thsp_get_theme_customizer_fields()		defined in /inc/theme-options/get-options.php
 * @return	array	$thsp_option_defaults		array of option defaults
 * @since Cazuela 1.0
 */
function thsp_get_theme_option_defaults() {

	// Get the array that holds all theme option fields
	$thsp_sections = thsp_get_theme_customizer_fields();
	
	// Initialize the array to hold the default values for all theme options
	$thsp_option_defaults = array();
	
	// Loop through the option parameters array
	foreach ( $thsp_sections as $thsp_section ) {
	
		$thsp_section_fields = $thsp_section['fields'];
		
		foreach ( $thsp_section_fields as $thsp_field_key => $thsp_field_value ) {

			// Add an associative array key to the defaults array for each option in the parameters array
			if( isset( $thsp_field_value['default'] ) ) {
				$thsp_option_defaults[$thsp_field_key] = $thsp_field_value['default'];
			} else {
				$thsp_option_defaults[$thsp_field_key] = false;
			}
			
		}
		
		
	}
	
	// Return the defaults array
	return $thsp_option_defaults;
	
}