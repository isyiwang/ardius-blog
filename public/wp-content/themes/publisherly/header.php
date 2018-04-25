<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package publisherly
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'publisherly' ); ?></a> <!-- add this reference in code -->

	<?php
	$header_top_bar = get_theme_mod( 'header_top_bar', '1' );
	if ( $header_top_bar == '1' ) {
		?>

		<div class="topbar">

			<div class="header-wrapper">

				<div class="secondary-menu">

					<ul>
						<?php
						wp_nav_menu( array(
							'container' => '', /* removes default container */
							'items_wrap' => '%3$s', /* removes ul and class */
							'theme_location' => 'secondary',
						) );
						?>
					</ul>

				</div>

				<div class="social-media">

					<?php publisherly_social_media(); ?>

				</div>

			</div>

		</div>

	<?php
	}
	?>

	<header id="masthead" class="site-header" role="banner">

		<div class="header-wrapper">

			<div class="site-branding">

				<?php publisherly_site_branding(); ?>

			</div><!-- .site-branding -->

			<?php if ( has_nav_menu( 'primary' ) ) : ?>

				<a id="menu-toggle" class="menu-toggle" href="#"><i class="fa fa-bars"></i> <?php esc_html_e( 'Menu', 'publisherly' ); ?></a>

				<div id="site-header-menu" class="site-header-menu">

					<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Menu', 'publisherly' ); ?>">

						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
							) );
						?>

					</nav><!-- .main-navigation -->

				</div><!-- .site-header-menu -->

			<?php endif; ?>

		</div><!-- /header-wrapper -->

	</header><!-- .site-header -->
