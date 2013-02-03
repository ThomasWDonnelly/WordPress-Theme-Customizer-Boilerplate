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