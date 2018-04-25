<?php
/**
 * publisherly setup
 *
 * @package publisherly
 */

if ( ! function_exists( 'publisherly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function publisherly_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'publisherly', get_template_directory() . '/languages' );

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * This theme uses wp_nav_menu()
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'publisherly' ),
			'secondary' => esc_html__( 'Secondary Menu', 'publisherly' ),
		) );

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support( 'custom-logo', apply_filters( 'publisherly_custom_logo_args', array(
			'width'       => 300,
			'height'      => 60,
			'flex-height' => true,
			'flex-width'  => true,
		) ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Set up the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( 'publisherly_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	}
endif;
add_action( 'after_setup_theme', 'publisherly_setup' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
function publisherly_add_image_sizes() {

	add_theme_support( 'post-thumbnails' );

	// Set default Post Thumbnail size.
	set_post_thumbnail_size( 1200, 675, array( 'center', 'center' ) );

	// Add different thumbnail sizes
	add_image_size( 'featured', 800, 400, array( 'center', 'center' ) ); // thumbnail index page
	add_image_size( 'thumb', 90, 80, array( 'center', 'center' ) ); // thumbnail related posts

}
add_action( 'after_setup_theme', 'publisherly_add_image_sizes' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function publisherly_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'publisherly_content_width', 800 );
}
add_action( 'after_setup_theme', 'publisherly_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function publisherly_widgets_init() {

	require( PUBLISHERLY_INCLUDES_DIR . 'widgets/recent-posts.php' );
	register_widget( 'mighty_widget_recent_posts' );

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'publisherly' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Widgets in this area will be shown in the sidebar.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 1', 'publisherly' ),
			'id' 			=> 'footer-1',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 2', 'publisherly' ),
			'id' 			=> 'footer-2',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 3', 'publisherly' ),
			'id' 			=> 'footer-3',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 4', 'publisherly' ),
			'id' 			=> 'footer-4',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

}
add_action( 'widgets_init', 'publisherly_widgets_init' );
