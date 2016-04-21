<?php use Roots\Sage\Extras; ?>
<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <div class="me_on_fb">
    <a href="https://facebook.com/yoginiballerina" target="_blank">
      Find me on <i class="fa fa-facebook-official fa-3x"></i></a>
    </div>

    <div id="share"></div>
    <a href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <?php echo get_bloginfo ( 'description' ); ?> Pensacola, Gulf Breeze, Pace, Florida, Gulf Coast
  </div>

    <?php Extras\bns_dynamic_copyright( 'start=Copyright&end=All Rights Reserved.' ); ?>
</footer>
