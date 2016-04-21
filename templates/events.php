<?php

use Roots\Sage\EventsOptions;

/**
 * events.php
 * Template for posts by category, tag, author, date, etc.
 */

?>




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


					<?php
						// Start the loop
					?>
						<?php
							// Insert the post content
							get_template_part( 'content', get_post_type() );
						?>

<?php endif; ?>


