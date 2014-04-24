<header class="banner navbar navbar-default navbar-fixed-top navbar-fixed-top-responsive" role="banner">
  <div class="container">
    <div class="navbar-header">

      <a class="navbar-brand" href="<?php echo home_url(); ?>/">
        <span class="text-hide"><?php bloginfo('name'); ?></span>
        <img src="<?php bloginfo('template_directory') ?>/assets/img/FORWARD_2014_logo_small-02.svg" alt="<?php bloginfo('name'); ?>"></a>
      
      <a class="navbar-brand" href="http://forward2014.brownpapertickets.com">
        <span class="sr-only text-hide">Buy Tickets</span>
        <img src="<?php bloginfo('template_directory') ?>/assets/img/dates.gif" alt="May 14 - 18, 2014"></a>

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-social">
        <span class="sr-only">Toggle Social</span>
        <span class="glyphicon glyphicon-thumbs-up"></span>
      </button>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigator">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
        <!-- <span class="glyphicon glyphicon-th-list"></span -->>
      </button>

    </div>


    <nav class="collapse navbar-collapse small navbar-right" role="navigation" id="navigator">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav tk-changeling-neo'));
        endif;
      ?>
    </nav>

    <nav class="collapse navbar-collapse small navbar-right" role="navigation" id="navbar-social">
      <ul class="nav-pills nav">
        <li><a href="http://facebook.com/forwarddc"><i class="fa fa-facebook-square fa-2x"></i></a></li>
        <li><a href="http://twitter.com/FORWARDfestival"><i class="fa fa-twitter-square fa-2x"></i></a></li>
        <li><a href="http://vimeo.com/channels/forwarddc/"><i class="fa fa-vimeo-square fa-2x"></i></a></li>
        <li><a href="http://forwarddc.tumblr.com/"><i class="fa fa-tumblr-square fa-2x"></i></a></li>
        <li><a href="https://www.flickr.com/groups/1851271@N25/"><i class="fa fa-flickr fa-2x"></i></a></li>
      </ul>
    </nav>
  </div>
</header>
<img src="/wp-content/themes/roots/assets/img/top_banner.png" class="img-responsive" id="topbar">
