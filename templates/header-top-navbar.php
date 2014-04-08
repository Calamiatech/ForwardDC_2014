<header class="banner navbar navbar-default navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="glyphicon glyphicon-th-list"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>/">
        <span class="text-hide"><?php bloginfo('name'); ?></span>
        <img src="<?php bloginfo('template_directory') ?>/assets/img/FORWARD_2014_logo_small-02.svg" height="45px" alt=""></a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav tk-changeling-neo'));
        endif;
      ?>
    </nav>
  </div>
</header>
<img src="/wp-content/themes/roots/assets/img/top_banner.png" class="img-responsive" id="topbar">
