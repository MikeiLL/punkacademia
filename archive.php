<?php

/**
 * archive.php
 * Template for posts by category, tag, author, date, etc.
 */
use Roots\Sage\EventsOptions;

get_header(); ?>


<?php if (have_posts()) : ?>

	<?php
		// Skip if pet listings or events
		if ( !is_post_type_archive( array( 'punkacademia-events' ) ) ) :
	?>
		<header>
			<h1>
				<?php if ( is_category() ) : // If this is a category archive ?>
					<?php _e( 'Category:', 'punkacademia' ); ?> <?php single_cat_title(); ?>...
				<?php elseif( is_tag() ) : // If this is a tag archive ?>
					<?php _e( 'Tag:', 'punkacademia' ); ?> <?php single_tag_title(); ?>...
				<?php elseif ( is_day() ) : // If this is a daily archive ?>
					<?php _e( 'Day:', 'punkacademia' ); ?> <?php the_time('F jS, Y'); ?>...
				<?php elseif ( is_month() ) : // If this is a monthly archive ?>
					<?php _e( 'Month:', 'punkacademia' ); ?> <?php the_time('F, Y'); ?>...
				<?php elseif ( is_year() ) : // If this is a yearly archive ?>
					<?php _e( 'Year:', 'punkacademia' ); ?> <?php the_time('Y'); ?>...
				<?php elseif ( is_author() ) : // If this is an author archive ?>
					<?php _e( 'Author Archive', 'punkacademia' ); ?>
				<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : // If this is a paged archive ?>
					<?php _e( 'Blog Archive', 'punkacademia' ); ?>
				<?php endif; ?>
			</h1>
		</header>
	<?php endif; ?>

	<section>
		<?php if ( is_post_type_archive( 'punkacademia-events' ) ) : ?>

			<?php
				$events_options = EventsOptions\punkacademia_events_get_theme_options();
				$events_date = get_query_var( 'date' );

				if ( !empty( $events_date ) ) :
			?>

				<header>
					<h1>
						<?php echo esc_html( $events_options['page_title_' . $events_date] ); ?>
					</h1>
				</header>

				<?php echo do_shortcode( wpautop( stripslashes( $events_options['page_content_' . $events_date] ) ) ); ?>

			<?php endif; ?>

		<?php endif; ?>

					<?php
						// Start the loop
						while (have_posts()) : the_post();
					?>
						<?php
							// Insert the post content
							get_template_part( 'content', get_post_type() );
						?>
					<?php endwhile; ?>

	</section>


	<?php
		// Previous/next page navigation
		get_template_part( 'nav', 'page' );
	?>


<?php else : ?>
	<?php
		// If no content, include the "No post found" template
		get_template_part( 'content', 'none' );
	?>
<?php endif; ?>


<?php get_footer(); ?>
