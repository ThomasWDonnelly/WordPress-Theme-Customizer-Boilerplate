<?php

/**
 * Capability Required to Save Theme Options
 *
 * @return	string	The capability to actually use
 */
function thsp_settings_page_capability() {

	return apply_filters( 'thsp_settings_page_capability_filter', 'edit_theme_options' );

}


/**
 * Get Option Values
 * 
 * Array that holds all of the options values
 * Option's default value is used if user hasn't specified a value
 *
 * @uses	thsp_get_theme_customizer_defaults()	defined in /customizer/options.php
 * @return	array									Current values for all options
 * @since	Theme_Customizer_Boilerplate 1.0
 */
function thsp_get_theme_options() {

	// Get the option defaults
	$option_defaults = thsp_get_theme_options_defaults();
	
	// Parse the stored options with the defaults
	$thsp_cazuela_options = wp_parse_args( get_option( 'my_theme_options', array() ), $option_defaults );
	
	// Return the parsed array
	return $thsp_cazuela_options;
	
}


/**
 * Get Option Defaults
 * 
 * Returns an array that holds default values for all options
 * 
 * @uses	thsp_get_theme_customizer_fields()	defined in /customizer/options.php
 * @return	array	$thsp_option_defaults		Default values for all options
 * @since	Theme_Customizer_Boilerplate 1.0
 */
function thsp_get_theme_options_defaults() {

	// Get the array that holds all theme option fields
	$thsp_sections = thsp_get_theme_customizer_fields();
	
	// Initialize the array to hold the default values for all theme options
	$thsp_option_defaults = array();
	
	// Loop through the option parameters array
	foreach ( $thsp_sections as $thsp_section ) {
	
		$thsp_section_fields = $thsp_section['fields'];
		
		foreach ( $thsp_section_fields as $thsp_field_key => $thsp_field_value ) {

			// Add an associative array key to the defaults array for each option in the parameters array
			if( isset( $thsp_field_value['setting_args']['default'] ) ) {
				$thsp_option_defaults[$thsp_field_key] = $thsp_field_value['setting_args']['default'];
			} else {
				$thsp_option_defaults[$thsp_field_key] = false;
			}
			
		}
		
	}
	
	// Return the defaults array
	return $thsp_option_defaults;
	
}