<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package publisherly
 */

?>

<footer class="site-footer">

	<div class="wrapper">

		<div class="footer-block">

		<?php
		// Show widget
		if ( is_active_sidebar( 'footer-1' ) ) { ?>

			<div class="column">

				<?php dynamic_sidebar( 'footer-1' ); ?>

			</div>

			<?php
		}

		// Show widget
		if ( is_active_sidebar( 'footer-2' ) ) { ?>

			<div class="column">

				<?php dynamic_sidebar( 'footer-2' ); ?>

			</div>

			<?php
		}

		// Show widget
		if ( is_active_sidebar( 'footer-3' ) ) { ?>

			<div class="column">

				<?php dynamic_sidebar( 'footer-3' ); ?>

			</div>

			<?php
		}

		// Show widget
		if ( is_active_sidebar( 'footer-4' ) ) { ?>

			<div class="column">

				<?php dynamic_sidebar( 'footer-4' ); ?>

			</div>

			<?php
		}
		?>

		</div><!-- /footer-block -->
	
	</div><!-- /wrapper -->

</footer><!-- /footer -->

<div class="copyright">

	<div class="wrapper">

		<div class="footer-block">

			<div class="footer-info">

			<?php echo wp_kses_post( get_theme_mod( 'footer-info', sprintf( esc_html__( 'Copyright 2018 - All rights reserved', 'publisherly' ) ) ) ); ?>

			</div>

			<div class="design-by">

			<?php
			/* translators: %s: designer name link. */
			echo wp_kses_post( get_theme_mod( 'design_by', sprintf( esc_html__( 'Publisherly Theme made by %s', 'publisherly' ), '<a href="https://mightywp.com/themes/publisherly/" rel="designer">Mighty WP</a>' ) ) ); ?>

			</div>

		</div><!-- /footer-block -->
			
	</div><!-- /wrapper -->

</div><!-- /copyright -->

<?php wp_footer(); ?>

</body>
</html>

