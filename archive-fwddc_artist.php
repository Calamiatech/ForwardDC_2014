<?php get_template_part('templates/page', 'header'); ?>

<section class="container-fluid">
  <div class="row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'isotope'); ?>
<?php endwhile; ?>
  </div>
</section>
<?php echo '<h1>'.is_page_template('archive-fwddc_artist.php' ).'</h1>'; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('<span class="glyphicon glyphicon-chevron-left"></span> Next', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Prev <span class="glyphicon glyphicon-chevron-right"></span>', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
