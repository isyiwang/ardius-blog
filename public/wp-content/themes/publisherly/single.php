<?php
/**
 * The template for displaying all single posts.
 *
 * @package publisherly
 */

get_header(); ?>

<div id="content" class="site-content" >

	<div id="primary" class="content-wrapper">

		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				// show post navigation
				$post_navigation = get_theme_mod( 'post_navigation', '1' );
				if ( $post_navigation == '1' ) {

					$args = array(
						'prev_text'          => '<span class="meta-navigation">' . esc_html__( 'Previous ', 'publisherly' ) . '</span><span class="title-navigation">%title</span>',
						'next_text'          => '<span class="meta-navigation">' . esc_html__( 'Next ', 'publisherly' ) . '</span><span class="title-navigation">%title</span>',
					);
					the_post_navigation( $args );
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- /main -->

	</div><!-- /content-wrapper -->

	<?php
	get_sidebar();
	?>

</div><!-- /content -->

<?php
get_footer();
