<?php

/**
 * Plugin Name: Default Button URL for Learndash Courses
 * Description: Define or display option for Button URL within Learndash course settings.
 * Author: Jeff Brand
 * Version: 1.0
 * License: GPLv2 or later
 **/

// Add URL to wp-config.php:
// define( 'DF_DEFAULT_COURSE_BUTTON_URL', '<URL to use>' );

if ( defined( 'DF_DEFAULT_COURSE_BUTTON_URL' ) ) {
	$field_ids = [ 'learndash-course-access-settings_course_price_type_closed_custom_button_url' ];

	// Begin: Option 1
	// Populate empty Button URL field with the defined default.
	add_filter( 'learndash_settings_field', function( $args ) use ( $field_ids ) {
		if ( in_array( $args['id'], $field_ids ) ) {
			if ( $args['value'] === '' ) {
				$args['value'] = DF_DEFAULT_COURSE_BUTTON_URL;
			}
		}

		return $args;
	});
	// End: Option 1

	// Begin: Option 2
	// OR, Show after field as hint to instructor
	add_filter( 'learndash_settings_field_html_after', function( $html, $args ) use ( $field_ids ) {
		if ( in_array( $args['id'], $field_ids ) ) {
			$html .= ' <em>Default Course URL: ' . esc_html( DF_DEFAULT_COURSE_BUTTON_URL ) . '</em>';
		}

		return $html;
	}, 10, 2 );
	// End: option 2
}
