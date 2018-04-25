<?php
/**
 * The recent posts widget.
 *
 * @package publisherly
 */
class mighty_widget_recent_posts extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$widget_options = array(
			'classname' => 'widget-recent-posts',
			'description' => 'Display recent posts with featured image',
	  );
	  parent::__construct( 'widget-recent-posts', esc_html__( 'Publisherly: Recent Posts', 'publisherly' ), $widget_options );
	}

	/**
	 * Display widget
	 */
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$number_of_posts = $instance['number_of_posts'];
		?>

		<?php
		// change to check if title exists
	  echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

		if ( $number_of_posts == 0 ) {
			$number_of_posts = 6;
		}

		$query_args = array(
			'post_type'     		  => 'post',
			'posts_per_page' 			=> $number_of_posts,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		);

		$query = new WP_Query ( $query_args );

		if ( $query -> have_posts() ) :

			/* Start the Loop */
			while ( $query -> have_posts() ) : $query -> the_post(); ?>

				<div class="wrapper">

				<?php
				if ( has_post_thumbnail() ) { ?>

					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'thumb' ); ?>
					</a>

				<?php } ?>

				<?php
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
				?>

				</div>

			<?php
			endwhile;

		endif;
		wp_reset_query();

		echo $args['after_widget'];
		?>

	<?php
	}

	/**
	 * Display widget settings
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$number_of_posts = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : '';
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'publisherly' ); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php esc_html_e( 'Number of posts to show', 'publisherly' ); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" value="<?php echo esc_attr( $number_of_posts ); ?>" />
		</p>

		<?php
	}

	/**
	 * Update widget
	 */
	 public function update( $new_instance, $old_instance ) {

	   $instance = $old_instance;
		 $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	   $instance[ 'number_of_posts' ] = absint( $new_instance[ 'number_of_posts' ] );
	   return $instance;

	 }

}
?>
