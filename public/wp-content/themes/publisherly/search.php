<?php
/**
 * The template for displaying search results pages.
 *
 * @package publisherly
 */

get_header(); ?>

<div id="content" class="site-content" >

	<div id="primary" class="content-wrapper">

		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'publisherly' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

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
