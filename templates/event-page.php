<?php while (have_posts()) : the_post(); ?>
	<?php if ($event_date = new DateTime(str_replace('-', '/', get_post_meta( $post->ID, '_fwddc_event_event_date_startdate', TRUE )))): ?>
	<h4> EVENT DATE: <?php echo $event_date->format( "m/d/Y"); ?> </h4>
	<?php endif ?>

	<?php if ($event_tix_link = get_post_meta( $post->ID, "_fwddc_event_tix", TRUE )): ?>
	<h5 class="buytickets"><a href="<?php $event_tix_link ?>"><i class="fa fa-ticket fa-2x pull-right"></i></a></h5>
	<?php endif /* end event tix link check */ ?>

	<?php if ($event_fb_link = get_post_meta( $post->ID, '_fwddc_event_fb', TRUE )): ?>
	<h5 class="fb_link"><a href="http://facebook.com/events/<?php echo $event_fb_link ?>"><i class="fa fa-facebook-square pull-right fa-2x"></i></a></h5>
	<?php endif /* end fb link check */ ?>

	<?php if ($event_tix_price = get_post_meta( $post->ID, '_fwddc_event_tix_price', TRUE )): ?>
	<h5 class="tix-price"><i class="fa fa-dollar"></i><?php echo $event_tix_price ?></h5>
	<?php endif /* end tix price check */ ?>

  <?php the_content(); ?>
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>
