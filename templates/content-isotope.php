<article <?php post_class(array('container', 'col-sm-6','col-md-4','col-lg-2','isotope-ready')); ?>>
  <!-- TEST -->
  <header>
    <h3 class="entry-title"><?php the_title(); ?></h3>
  </header>
  <div class="entry-content">
    <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
    <?php the_content(); ?>
  </div>
  <footer>
    <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
  </footer>
</article>
