<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package publisherly
 */

?>

<article id="post-<?php the_ID(); ?>" class="article-posts" <?php post_class(); ?>>

	<!-- Post Thumbnail -->
	<?php if ( has_post_thumbnail() ) : ?>

		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'featured' ); ?>
			</a>
		</div>

	<?php endif; ?>

	<div class="entry">

		<header class="entry-header">

			<?php
			the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

		</header>

		<div class="entry-meta">

			<?php publisherly_entry_meta();	?>

		</div>

		<div class="entry-content">

			<?php
			the_content( '' ,true, '' );
			?>

			<div class="more-link"><a href="<?php echo esc_url( get_permalink() ) ?>"><?php esc_html_e( 'Continue reading &raquo;', 'publisherly' ); ?></a></div>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'publisherly' ),
				'after'  => '</div>',
			) );
			?>

		</div><!-- /entry-content -->

	</div><!-- /entry -->

</article><!-- /article -->
