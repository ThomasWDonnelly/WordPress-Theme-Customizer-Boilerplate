<?php

/**
 * Capability Required to Save Theme Options
 *
 * @return	string	The capability to actually use
 */
function thsp_settings_page_capability() {

	return 'edit_theme_options';

}
add_filter( 'thsp_settings_page_capability_filter', 'thsp_settings_page_capability' );


/**
 * Array of Theme Customizer Sections
 *
 * @since	Theme_Customizer_boilerplate 1.0
 */
function thsp_get_theme_customizer_sections() {

	$thsp_options_fields = thsp_get_theme_customizer_fields();
	$thsp_sections = array();

	foreach ( $thsp_options_fields as $thsp_section_key => $thsp_section_value ) {
	
		$thsp_sections[] = $thsp_section_key;
		
	}
	
	return $thsp_sections;
	
}
