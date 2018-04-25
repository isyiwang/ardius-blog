<?php
/**
 * publisherly functions and definitions
 *
 * @package publisherly
 */

if ( ! defined( 'PUBLISHERLY_VERSION' ) ) {
	define( 'PUBLISHERLY_VERSION', '1.1.4' );
}

if ( ! defined( 'PUBLISHERLY_INCLUDES_DIR' ) ) {
	define( 'PUBLISHERLY_INCLUDES_DIR', trailingslashit( get_template_directory() ) . 'inc/' );
}

require_once( PUBLISHERLY_INCLUDES_DIR . 'setup.php' );

/**
 * Register Google fonts
 *
 * @return string Encoded Google fonts URL
 */
if ( ! function_exists( 'publisherly_fonts' ) ) {

	function publisherly_fonts() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		$fonts[] = 'Lato:400,700';
		$fonts[] = 'Open Sans:400,700';

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
}

/**
 * Enqueue scripts and styles.
 */
function publisherly_scripts() {

	// Load Main Stylesheet
	wp_enqueue_style( 'publisherly-stylesheet', get_stylesheet_uri(), array() );

	// Add Google fonts
	wp_enqueue_style( 'publisherly-fonts', publisherly_fonts(), array(), null );

	// Font Awesome
	wp_enqueue_style( 'publisherly-fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), null );

	// Makes "skip to content" link work correctly
	wp_enqueue_script( 'publisherly-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), null, true );

	// JS file for main navigation
	wp_enqueue_script( 'publisherly-script', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), null, true );

	wp_localize_script( 'publisherly-script', 'publisherlyScreenReaderText', array(
		'expand'   => __( 'expand child menu', 'publisherly' ),
		'collapse' => __( 'collapse child menu', 'publisherly' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'publisherly_scripts' );

/**
 * Customizer additions.
 */
require_once( PUBLISHERLY_INCLUDES_DIR . 'customizer.php' );

/**
 * Custom template tags for this theme.
 */
require_once( PUBLISHERLY_INCLUDES_DIR . 'template-tags.php' );

/**
 * Load Jetpack compatibility file.
 */
require_once( PUBLISHERLY_INCLUDES_DIR . 'jetpack.php' );

/**
 * Load admin theme page.
 */
require_once( PUBLISHERLY_INCLUDES_DIR . 'theme-info.php' );
