<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'punkacademia'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<?php echo category_description(); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/class-name-content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
