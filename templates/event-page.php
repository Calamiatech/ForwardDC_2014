<?php while (have_posts()) : the_post(); ?>
	<h4> EVENT DATE: <?php echo get_post_meta( $post->ID, '_fwddc_event_event_date_startdate', TRUE ); ?> </h4>
  <?php the_content(); ?>
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>
