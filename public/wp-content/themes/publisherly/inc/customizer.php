<?php
/**
 * Theme Customizer
 *
 * @package publisherly
 */

/**
* Add postMessage support for site title and description for the Theme Customizer.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function publisherly_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'publisherly_customize_register' );

/**
* Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function publisherly_customize_preview_js() {
	wp_enqueue_script( 'publisherly_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'publisherly_customize_preview_js' );

/**
* Customizer: Remove Unecessary Controls
*/
function publisherly_remove_customizer_settings( $wp_customize ) {

	/*
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}

	// $wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );

}
add_action( 'customize_register', 'publisherly_remove_customizer_settings', 20 );

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function publisherly_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitization callback for 'select' and 'radio' type controls.
 *
 * @source https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php#L262-L288
 */
if ( ! function_exists( 'publisherly_sanitize_select_radio' ) ) {
	function publisherly_sanitize_select_radio( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

/**
 * Sanitize hex colors
 */
function publisherly_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );

	// If $input is a valid hex value, return it; otherwise, return the default.
	return $hex_color;
}

/**
 * Customizer: Add Panels
 */
function publisherly_register_customizer_panels( $wp_customize ) {

	/*
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}

}
add_action( 'customize_register', 'publisherly_register_customizer_panels' );

/**
 * Customizer: Add Sections
 */
function publisherly_register_customizer_sections( $wp_customize ) {

	/*
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}

	/**
	 * Add Header Section.
	 */
	$wp_customize->add_section(
		'section_header_settings',
		array(
			'title'         => esc_html__( 'Header', 'publisherly' ),
			'priority'      => 90,
		)
	);

	/**
	 * Add Footer Section.
	 */
	$wp_customize->add_section(
		'section_footer_settings',
		array(
			'title'         => esc_html__( 'Footer', 'publisherly' ),
			'priority'      => 109,
		)
	);

}
add_action( 'customize_register', 'publisherly_register_customizer_sections' );

/**
 * Customizer: Add Settings and Controls
 */
function publisherly_register_customizer_settings_controls( $wp_customize ) {

	/*
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}

	// Show Header Top Bar
	$wp_customize->add_setting(
		'header_top_bar',
		array(
			'default'           => true,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'header_top_bar',
		array(
			'settings'      => 'header_top_bar',
			'section'       => 'section_header_settings',
			'type'          => 'checkbox',
			'label'         => esc_html__( 'Show theme top bar?', 'publisherly' ),
		)
	);

	// Social Links Twitter
	$wp_customize->add_setting(
		'social_media_twitter',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_twitter',
		array(
			'settings'      => 'social_media_twitter',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Twitter URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Twitter social page.', 'publisherly' ),
		)
	);

	// Social Links Facebook
	$wp_customize->add_setting(
		'social_media_facebook',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_facebook',
		array(
			'settings'      => 'social_media_facebook',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Facebook URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Facebook social page.', 'publisherly' ),
		)
	);

	// Social Links Google Plus
	$wp_customize->add_setting(
		'social_media_googleplus',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_googleplus',
		array(
			'settings'      => 'social_media_googleplus',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Google+ URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Google+ social page.', 'publisherly' ),
		)
	);

	// Social Links Pinterest
	$wp_customize->add_setting(
		'social_media_pinterest',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_pinterest',
		array(
			'settings'      => 'social_media_pinterest',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Pinterest URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Pinterest social page.', 'publisherly' ),
		)
	);

	// Social Links YouTube
	$wp_customize->add_setting(
		'social_media_youtube',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_youtube',
		array(
			'settings'      => 'social_media_youtube',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'YouTube URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your YouTube social page.', 'publisherly' ),
		)
	);

	// Social Links Instagram
	$wp_customize->add_setting(
		'social_media_instagram',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_instagram',
		array(
			'settings'      => 'social_media_instagram',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Instagram URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Instagram social page.', 'publisherly' ),
		)
	);

	// Social Links LinkedIn
	$wp_customize->add_setting(
		'social_media_linkedin',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_linkedin',
		array(
			'settings'      => 'social_media_linkedin',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'LinkedIn URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your LinkedIn social page.', 'publisherly' ),
		)
	);

	// Social Links Behance
	$wp_customize->add_setting(
		'social_media_behance',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_behance',
		array(
			'settings'      => 'social_media_behance',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Behance URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Behance social page.', 'publisherly' ),
		)
	);

	// Social Links Tumblr
	$wp_customize->add_setting(
		'social_media_tumblr',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_tumblr',
		array(
			'settings'      => 'social_media_tumblr',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Tumblr URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Tumblr social page.', 'publisherly' ),
		)
	);

	// Social Links Vimeo
	$wp_customize->add_setting(
		'social_media_vimeo',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_vimeo',
		array(
			'settings'      => 'social_media_vimeo',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Vimeo URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Vimeo social page.', 'publisherly' ),
		)
	);

	// Social Links Dribble
	$wp_customize->add_setting(
		'social_media_dribble',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'social_media_dribble',
		array(
			'settings'      => 'social_media_dribble',
			'section'       => 'section_header_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Dribble URL', 'publisherly' ),
			'description'   => esc_html__( 'Link to your Dribble social page.', 'publisherly' ),
		)
	);

	// Footer Copyright Left Content
	$wp_customize->add_setting(
		'footer-info',
		array(
			'default'           => esc_html__( 'Copyright 2018 - All rights reserved', 'publisherly' ),
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'footer-info',
		array(
			'settings'      => 'footer-info',
			'section'       => 'section_footer_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Copyright Text', 'publisherly' ),
			'description'   => esc_html__( 'Copyright or other text to be displayed in the footer left side. HTML allowed.', 'publisherly' ),
		)
	);

	// Footer Copyright Right Content
	$wp_customize->add_setting(
		'design_by',
		array(
			'default'           => esc_html__( 'Publisherly Theme made by <a href="https://mightywp.com/themes/publisherly/">Mighty WP</a>', 'publisherly' ),
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'design_by',
		array(
			'settings'      => 'design_by',
			'section'       => 'section_footer_settings',
			'type'          => 'text',
			'label'         => esc_html__( 'Text on the right', 'publisherly' ),
			'description'   => esc_html__( 'Design Author text or other text to be displayed in the footer right side. HTML allowed.', 'publisherly' ),
		)
	);

	// Top Bar Link Color
	$wp_customize->add_setting(
		'topbar_link_color',
		array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'topbar_link_color',
			array(
				'settings'  => 'topbar_link_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Top Bar Link Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Top Bar Link Color Hover
	$wp_customize->add_setting(
		'topbar_link_color_hover',
		array(
			'default'           => '#ef403d',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'topbar_link_color_hover',
			array(
				'settings'  => 'topbar_link_color_hover',
				'section'   => 'colors',
				'label'     => esc_html__( 'Top Bar Link Color Hover', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Top Bar Background Color
	$wp_customize->add_setting(
		'topbar_background_color',
		array(
			'default'           => '#0d0d0d',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'topbar_background_color',
			array(
				'settings'  => 'topbar_background_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Top Bar Background Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Header Link Color
	$wp_customize->add_setting(
		'header_link_color',
		array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_link_color',
			array(
				'settings'  => 'header_link_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Header Link Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Header Link Color Hover
	$wp_customize->add_setting(
		'header_link_color_hover',
		array(
			'default'           => '#333333',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_link_color_hover',
			array(
				'settings'  => 'header_link_color_hover',
				'section'   => 'colors',
				'label'     => esc_html__( 'Header Link Color Hover', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Header Background Color
	$wp_customize->add_setting(
		'header_background_color',
		array(
			'default'           => '#ef403d',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'settings'  => 'header_background_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Header Background Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Content Text Color
	$wp_customize->add_setting(
		'content_text_color',
		array(
			'default'           => '#4C4C4C',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_text_color',
			array(
				'settings'  => 'content_text_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Content Text Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Content Title Color
	$wp_customize->add_setting(
		'content_title_color',
		array(
			'default'           => '#333333',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_title_color',
			array(
				'settings'  => 'content_title_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Content Title Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Content Link Color
	$wp_customize->add_setting(
		'content_link_color',
		array(
			'default'           => '#333333',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_link_color',
			array(
				'settings'  => 'content_link_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Content Link Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Content Link Color Hover
	$wp_customize->add_setting(
		'content_link_color_hover',
		array(
			'default'           => '#ef403d',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_link_color_hover',
			array(
				'settings'  => 'content_link_color_hover',
				'section'   => 'colors',
				'label'     => esc_html__( 'Content Link Color Hover', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Content Pagination Link Color
	$wp_customize->add_setting(
		'content_pagination_color',
		array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_pagination_color',
			array(
				'settings'  => 'content_pagination_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Content Pagination Link Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Content Pagination Link Color Hover
	$wp_customize->add_setting(
		'content_pagination_color_hover',
		array(
			'default'           => '#ef403d',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_pagination_color_hover',
			array(
				'settings'  => 'content_pagination_color_hover',
				'section'   => 'colors',
				'label'     => esc_html__( 'Content Pagination Link Color Hover', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Content Pagination Background Color
	$wp_customize->add_setting(
		'content_pagination_background_color',
		array(
			'default'           => '#333333',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_pagination_background_color',
			array(
				'settings'  => 'content_pagination_background_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Content Pagination Background Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Footer Text Color
	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'settings'  => 'footer_text_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Footer Text Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Footer Title Color
	$wp_customize->add_setting(
		'footer_title_color',
		array(
			'default'           => '#f4f4f4',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_title_color',
			array(
				'settings'  => 'footer_title_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Footer Title Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Footer Link Color
	$wp_customize->add_setting(
		'footer_link_color',
		array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_link_color',
			array(
				'settings'  => 'footer_link_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Footer Link Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Footer Link Color Hover
	$wp_customize->add_setting(
		'footer_link_color_hover',
		array(
			'default'           => '#333333',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_link_color_hover',
			array(
				'settings'  => 'footer_link_color_hover',
				'section'   => 'colors',
				'label'     => esc_html__( 'Footer Link Color Hover', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Footer Background Color
	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'default'           => '#ef403d',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			array(
				'settings'  => 'footer_background_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Footer Background Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Copyright Text Color
	$wp_customize->add_setting(
		'copyright_text_color',
		array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_text_color',
			array(
				'settings'  => 'copyright_text_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Copyright Text Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Copyright Link Color
	$wp_customize->add_setting(
		'copyright_link_color',
		array(
			'default'           => '#ef403d',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_link_color',
			array(
				'settings'  => 'copyright_link_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Copyright Link Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Copyright Link Color Hover
	$wp_customize->add_setting(
		'copyright_link_color_hover',
		array(
			'default'           => '#333333',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_link_color_hover',
			array(
				'settings'  => 'copyright_link_color_hover',
				'section'   => 'colors',
				'label'     => esc_html__( 'Copyright Link Color Hover', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

	// Copyright Background Color
	$wp_customize->add_setting(
		'copyright_background_color',
		array(
			'default'           => '#0D0D0D',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'publisherly_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_background_color',
			array(
				'settings'  => 'copyright_background_color',
				'section'   => 'colors',
				'label'     => esc_html__( 'Copyright Background Color', 'publisherly' ),
				'priority'  => 30,
			)
		)
	);

}
add_action( 'customize_register', 'publisherly_register_customizer_settings_controls' );

/**
* Customizer: Colors
*/
function publisherly_customizer_colors() {

	$css = '';

	// Top Bar Link Color
	$topbar_link_color = get_theme_mod( 'topbar_link_color' );
	if ( $topbar_link_color ) {
		$css .= '.secondary-menu li a { color: ' . esc_html( $topbar_link_color ) . ' }';
		$css .= '.social-icon { color: ' . esc_html( $topbar_link_color ) . ' }';
	}

	// Top Bar Link Color Hover
	$topbar_link_color_hover = get_theme_mod( 'topbar_link_color_hover' );
	if ( $topbar_link_color_hover ) {
		$css .= '.secondary-menu li a:hover { color: ' . esc_html( $topbar_link_color_hover ) . ' }';
		$css .= '.social-icon:hover { color: ' . esc_html( $topbar_link_color_hover ) . ' }';
	}

	// Top Bar Background Color
	$topbar_background_color = get_theme_mod( 'topbar_background_color' );
	if ( $topbar_background_color ) {
		$css .= '.topbar { background-color: ' . esc_html( $topbar_background_color ) . ' }';
	}

	// Header Link Color
	$header_link_color = get_theme_mod( 'header_link_color' );
	if ( $header_link_color ) {
		$css .= '.site-title a, .site-title a:visited { color: ' . esc_html( $header_link_color ) . ' }';
		$css .= '.main-navigation a, .main-navigation a:visited { color: ' . esc_html( $header_link_color ) . ' }';
	}

	// Header Link Color Hover
	$header_link_color_hover = get_theme_mod( 'header_link_color_hover' );
	if ( $header_link_color_hover ) {
		$css .= '.site-title a:hover, .site-title a:focus, .site-title a:active { color: ' . esc_html( $header_link_color_hover ) . ' }';
		$css .= '.main-navigation li:hover > a, .main-navigation li.focus > a { color: ' . esc_html( $header_link_color_hover ) . ' }';
	}

	// Header Background Color
	$header_background_color = get_theme_mod( 'header_background_color' );
	if ( $header_background_color ) {
		$css .= '.site-header { background-color: ' . esc_html( $header_background_color ) . ' }';
	}

	// Content Text Color
	$content_text_color = get_theme_mod( 'content_text_color' );
	if ( $content_text_color ) {
		$css .= '.entry-content { color: ' . esc_html( $content_text_color ) . ' }';
		$css .= '.entry-meta { color: ' . esc_html( $content_text_color ) . ' }';
		$css .= '#sidebar-right .widget { color: ' . esc_html( $content_text_color ) . ' }';
	}

	// Content Title Color
	$content_title_color = get_theme_mod( 'content_title_color' );
	if ( $content_title_color ) {
		$css .= 'h1, h2, h3 { color: ' . esc_html( $content_title_color ) . ' }';
		$css .= '#sidebar-right .widget h4 { color: ' . esc_html( $content_title_color ) . ' }';
	}

	// Content Link Color
	$content_link_color = get_theme_mod( 'content_link_color' );
	if ( $content_link_color ) {
		$css .= '.entry a, .entry a:visited { color: ' . esc_html( $content_link_color ) . ' }';
		$css .= '.entry-meta a, .entry-meta a:visited, .entry-content a, .entry-content a:visited  { color: ' . esc_html( $content_link_color ) . ' }';
		$css .= '#sidebar-right .widget a, .widget a:visited { color: ' . esc_html( $content_link_color ) . ' }';
		$css .= '.nav-previous a, .nav-previous a:visited, .nav-next a, .nav-next a:visited { color: ' . esc_html( $content_link_color ) . ' }';
	}

	// Content Link Color Hover
	$content_link_color_hover = get_theme_mod( 'content_link_color_hover' );
	if ( $content_link_color_hover ) {
		$css .= '.entry a:hover, .entry a:focus, .entry a:active { color: ' . esc_html( $content_link_color_hover ) . ' }';
		$css .= '.entry-meta a:hover, .entry-meta a:focus, .entry-meta a:active, .entry-content a:hover, .entry-content a:focus, .entry-content a:active { color: ' . esc_html( $content_link_color_hover ) . ' }';
		$css .= '#sidebar-right .widget a:hover, .widget a:focus, .widget a:active { color: ' . esc_html( $content_link_color_hover ) . ' }';
		$css .= '.nav-previous a:hover, .nav-previous a:focus, .nav-previous a:active, .nav-next a:hover, .nav-next a:focus, .nav-next a:active { color: ' . esc_html( $content_link_color_hover ) . ' }';
	}

	// Content Pagination Color
	$content_pagination_color = get_theme_mod( 'content_pagination_color' );
	if ( $content_pagination_color ) {
		$css .= '.pagination .page-numbers { color: ' . esc_html( $content_pagination_color ) . ' }';
	}

	// Content Pagination Color Hover
	$content_pagination_color_hover = get_theme_mod( 'content_pagination_color_hover' );
	if ( $content_pagination_color_hover ) {
		$css .= '.pagination a:hover { background-color: ' . esc_html( $content_pagination_color_hover ) . ' }';
	}

	// Content Pagination Background Color
	$content_pagination_background_color = get_theme_mod( 'content_pagination_background_color' );
	if ( $content_pagination_background_color ) {
		$css .= '.pagination .page-numbers { background-color: ' . esc_html( $content_pagination_background_color ) . ' }';
	}

	// Footer Text Color
	$footer_text_color = get_theme_mod( 'footer_text_color' );
	if ( $footer_text_color ) {
		$css .= 'footer .widget { color: ' . esc_html( $footer_text_color ) . ' }';
	}

	// Footer Title Color
	$footer_title_color = get_theme_mod( 'footer_title_color' );
	if ( $footer_title_color ) {
		$css .= 'footer .widget h4 { color: ' . esc_html( $footer_title_color ) . '; }';
	}

	// Footer Link Color
	$footer_link_color = get_theme_mod( 'footer_link_color' );
	if ( $footer_link_color ) {
		$css .= 'footer .widget a, footer .widget a:visited { color: ' . esc_html( $footer_link_color ) . ' }';
	}

	// Footer Link Hover Color
	$footer_link_color_hover = get_theme_mod( 'footer_link_color_hover' );
	if ( $footer_link_color_hover ) {
		$css .= 'footer .widget a:hover, footer .widget a:focus, footer .widget a:active { color: ' . esc_html( $footer_link_color_hover ) . ' }';
	}

	// Footer Background Color
	$footer_background_color = get_theme_mod( 'footer_background_color' );
	if ( $footer_background_color ) {
		$css .= '.site-footer { background-color: ' . esc_html( $footer_background_color ) . ' }';
	}

	// Copyright Text Color
	$copyright_text_color = get_theme_mod( 'copyright_text_color' );
	if ( $copyright_text_color ) {
		$css .= '.footer-info, .design-by { color: ' . esc_html( $copyright_text_color ) . ' }';
	}

	// Copyright Link Color
	$copyright_link_color = get_theme_mod( 'copyright_link_color' );
	if ( $copyright_link_color ) {
		$css .= '.copyright a, .copyright a:visited { color: ' . esc_html( $copyright_link_color ) . ' }';
	}

	// Copyright Link Hover Color
	$copyright_link_color_hover = get_theme_mod( 'copyright_link_color_hover' );
	if ( $copyright_link_color_hover ) {
		$css .= '.copyright a:hover, .copyright a:focus, .copyright a:active { color: ' . esc_html( $copyright_link_color_hover ) . ' }';
	}

	// Copyright Background Color
	$copyright_background_color = get_theme_mod( 'copyright_background_color' );
	if ( $copyright_background_color ) {
		$css .= '.copyright { background-color: ' . esc_html( $copyright_background_color ) . ' }';
	}

	?>

	<style>

		<?php echo $css; ?>

	</style>

<?php
} // End customizer_colors()
add_action( 'wp_head', 'publisherly_customizer_colors' );
