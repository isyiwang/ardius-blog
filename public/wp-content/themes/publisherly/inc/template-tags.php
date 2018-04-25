<?php
/**
 * Custom template tags for this theme
 *
 * @package publisherly
 */

if ( ! function_exists( 'publisherly_site_branding' ) ) :
	/**
	 * Show Site Branding
	 *
	 */
	function publisherly_site_branding() {

		// Display the Custom Logo
		if ( has_custom_logo() ) {

			the_custom_logo();

		} else {

			if ( is_front_page() && is_home() ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php endif;

		}

	}
	endif;

if ( ! function_exists( 'publisherly_social_media' ) ) :
	/**
	 * Show Social Media Icons
	 *
	 */
	function publisherly_social_media() {

		if ( get_theme_mod( 'social_media_twitter' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_twitter', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Twitter', 'publisherly' ) ); ?>"><i class="fa fa-twitter-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_facebook' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_facebook', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Facebook', 'publisherly' ) ); ?>"><i class="fa fa-facebook-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_googleplus' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_googleplus', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Google Plus', 'publisherly' ) ); ?>"><i class="fa fa-google-plus-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_pinterest' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_pinterest', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Pinterest', 'publisherly' ) ); ?>"><i class="fa fa-pinterest-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_youtube' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_youtube', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'YouTube', 'publisherly' ) ); ?>"><i class="fa fa-youtube-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_instagram' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_instagram', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Instagram', 'publisherly' ) ); ?>"><i class="fa fa-instagram"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_linkedin' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_linkedin', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'LinkedIn', 'publisherly' ) ); ?>"><i class="fa fa-linkedin-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_behance' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_behance', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Behance', 'publisherly' ) ); ?>"><i class="fa fa-behance-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_tumblr' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_tumblr', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Tumblr', 'publisherly' ) ); ?>"><i class="fa fa-tumblr-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_vimeo' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_vimeo', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Vimeo', 'publisherly' ) ); ?>"><i class="fa fa-vimeo-square"></i></a>
			<?php
		}

		if ( get_theme_mod( 'social_media_dribble' ) ) { ?>
			<a href="<?php echo esc_url( get_theme_mod( 'social_media_dribble', '' ) ); ?>" class="social-icon" title="<?php sprintf( esc_html__( 'Dribble', 'publisherly' ) ); ?>"><i class="fa fa-dribbble"></i></a>
			<?php
		}

}
endif;

if ( ! function_exists( 'publisherly_entry_meta' ) ) :
	/**
	 * Show HTML with meta information for the date, author and categories.
	 *
	 */
	function publisherly_entry_meta() {

		// show meta date
		echo get_the_date();

		// show meta author
		echo ' | ';
		the_author_meta( 'display_name' );

		// show meta categories
		echo ' | ';
		the_category( ', ' );

}
endif;
