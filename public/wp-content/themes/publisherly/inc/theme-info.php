<?php
/**
 * Adds a custom Appearance sub-page in admin side.
 *
 * @package publisherly
 */

/**
 * Creates theme page inside Appearance panel.
 */
function publisherly_theme_info() {

	// Get theme details
	$theme = wp_get_theme();

	add_theme_page(
		$theme->display( 'Name' ),
		$theme->display( 'Name' ),
		'edit_theme_options',
		'publisherly',
		'publisherly_theme_info_page'
	);

}
add_action( 'admin_menu', 'publisherly_theme_info' );

/**
 * Display theme info page
 */
function publisherly_theme_info_page() {

	// Get theme details
	$theme = wp_get_theme();
	?>

	<div class="wrap about-wrap">

		<h1><?php printf( esc_html__( '%1$s %2$s', 'publisherly' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ); ?></h1>

		<p><?php echo $theme->display( 'Description' ); ?></p>

		<hr>

		<p><strong><?php esc_html_e( 'Theme Links', 'publisherly' ); ?>:</strong>
			<a href="<?php echo esc_url( __( 'https://mightywp.com/themes/publisherly-pro/', 'publisherly' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=publisherly&utm_content=theme-page' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'publisherly' ); ?></a>
			<a href="<?php echo esc_url( __( 'https://mightywp.com/documentation/publisherly-support/', 'publisherly' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=publisherly&utm_content=documentation' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'publisherly' ); ?></a>
		</p>

		<hr>

		<h3><?php printf( esc_html__( 'Getting Started with %s', 'publisherly' ), $theme->display( 'Name' ) ); ?></h3>

		<h4><?php esc_html_e( 'Theme Documentation', 'publisherly' ); ?></h4>

		<p><?php esc_html_e( 'We are working on documentation for this theme. Coming soon.', 'publisherly' ); ?></p>

		<p>
			<a href="<?php echo esc_url( __( 'https://mightywp.com/documentation/publisherly-support/', 'publisherly' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=publisherly&utm_content=documentation' ); ?>" target="_blank" class="button button-secondary">
			<?php printf( esc_html__( 'View %s Documentation', 'publisherly' ), $theme->display( 'Name' ) ); ?>
			</a>
		</p>

		<h4><?php esc_html_e( 'Theme Options', 'publisherly' ); ?></h4>

		<p><?php printf( esc_html__( '%s makes use of the Customizer for all theme settings.', 'publisherly' ), $theme->display( 'Name' ) ); ?></p>

		<p><a href="<?php echo wp_customize_url(); ?>" class="button button-primary"><?php esc_html_e( 'Customize Theme', 'publisherly' ); ?></a></p>

		<hr>

		<h3><?php esc_html_e( 'Get Pro Version', 'publisherly' ); ?></h3>

		<p class="about">
			<?php printf( esc_html__( 'Purchase %s Pro theme and get additional customization options.', 'publisherly' ), 'Publisherly' ); ?>
		</p>

		<p>
			<a href="<?php echo esc_url( __( 'https://mightywp.com/themes/publisherly-pro/', 'publisherly' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=publisherly&utm_content=pro-version' ); ?>" target="_blank" class="button button-secondary">
				<?php printf( esc_html__( 'Learn more about %s Pro', 'publisherly' ), 'Publisherly' ); ?>
			</a>
		</p>

		<hr>

		<p><?php printf( esc_html__( '%1$s is brought to you by %2$s.', 'publisherly' ),
			$theme->display( 'Name' ),
			'<a target="_blank" href="' . __( 'https://mightywp.com/', 'publisherly' ) . '?utm_source=theme-info&utm_medium=footer&utm_campaign=publisherly" title="Mighty WP">Mighty WP</a>' ); ?>
		</p>

	</div>

<?php
}
