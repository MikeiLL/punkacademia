<?php

/**
 * archive.php
 * Template for posts by category, tag, author, date, etc.
 */
use Roots\Sage\EventsOptions;
?>
 <?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>

<?php
  // Get Regular Content if not Events
  if ( !is_post_type_archive( array( 'punkacademia-events' ) ) ) :
?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php else: ?>
  <?php get_template_part('templates/events', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>

<?php the_posts_navigation(); ?>
<?php endif; ?>
<?php endwhile; ?>


