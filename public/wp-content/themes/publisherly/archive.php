<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package publisherly
 */

get_header(); ?>

<div id="content" class="site-content" >

	<div id="primary" class="content-wrapper">

		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
			?>

			<header class="page-header">

				<h1 class="page-title"><?php single_cat_title(); ?></h1>
				<?php
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>

			</header><!-- /page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile;

			the_posts_pagination( array(
				'mid_size' => 1,
				'prev_text' => esc_html__( 'Previous', 'publisherly' ),
				'next_text' => esc_html__( 'Next', 'publisherly' ),
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- /main -->

	</div><!-- /content-wrapper -->

	<?php
	get_sidebar();
	?>

</div><!-- /content -->

<?php
get_footer();
