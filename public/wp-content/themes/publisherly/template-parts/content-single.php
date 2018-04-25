<?php
/**
 * Template part for displaying posts.
 *
 * @package publisherly
 */
?>

<article id="post-<?php the_ID(); ?>" class="clearfix" <?php post_class(); ?>>

	<?php
	// show featured image
	if ( has_post_thumbnail() ) { ?>

		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'featured' ); ?>
			</a>
		</div>

	<?php } ?>

	<div class="entry">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		</header><!-- /page-header -->

		<div class="entry-meta clearfix">

			<?php publisherly_entry_meta();	?>

		</div>

		<?php //the_author_posts_link(); ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'publisherly' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'publisherly' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			// show tags
			$post_tags = get_theme_mod( 'post_tags', '1' );
			if ( $post_tags == '1' ) {

				if ( has_tag() ) { ?>
					<div class="tags">
						<h2 class="tags__title"><?php esc_html_e( 'Tags', 'publisherly' ); ?></h2>
						<div class="tags__items">
							<?php the_tags( '', '' ); ?>
						</div>
					</div>
				<?php }
			}
			?>
		</div><!-- /entry-content -->

	</div><!-- /entry -->

</article><!-- /article -->
