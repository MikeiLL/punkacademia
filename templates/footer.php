<?php use Roots\Sage\Extras; ?>
<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>

    <div id="share"></div>
    <a href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <?php echo get_bloginfo ( 'description' ); ?>
  </div>

    <?php Extras\bns_dynamic_copyright( 'start=Copyright&end=All Rights Reserved.' ); ?>
</footer>
