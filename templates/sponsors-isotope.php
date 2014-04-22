<section class="container-fluid">
	<div id="filters" class="row">
	
	</div>
  <div class="row js-isotope"
	id="sponsors-container" 
    data-isotope-options='{ 
		"itemSelector": ".sponsor", 
		"masonry": { 
			"columnWidth": ".sponsor", 
			"gutter":60
		},
		"getSortData": {
			"sponsorName": ".sponsorName"
		},
		"filter":".2014",
		"sortBy":"sponsorName"
	}'>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/sponsor', 'isotope'); ?>
<?php endwhile; ?>
  </div>
</section>
<?php echo '<h1>'.is_page_template('archive-fwddc_sponsor.php' ).'</h1>'; ?>

<?php /*if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="next"><?php next_posts_link(__('Next <span class="glyphicon glyphicon-chevron-right"></span>', 'roots')); ?></li>
      <li class="previous"><?php previous_posts_link(__('<span class="glyphicon glyphicon-chevron-left"></span> Prev', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; */ ?>