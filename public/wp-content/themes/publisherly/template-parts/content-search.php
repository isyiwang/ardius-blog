<?php
/**
 * Template part for displaying results in search pages.
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
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			if ( 'post' === get_post_type() ) :

			endif; ?>

		</header>

		<div class="entry-meta">

			<?php publisherly_entry_meta();	?>

		</div>

		<div class="entry-content">

			<?php the_excerpt( '',true,'' ); ?>

			<div class="more-link"><a href="<?php echo esc_url( get_permalink() ) ?>"><?php esc_html_e( 'Continue reading &raquo;', 'publisherly' ); ?></a></div>

		</div><!-- /entry-content -->

	</div><!-- /entry -->

</article><!-- /article -->
