
<?php
/* Post Container Styles */
$post_classes = array(
	'sponsor',
	
	'col-sm-6',
	'col-md-4',
	'col-lg-3',
	'col-xl-2',

	'isotope-ready',
	);
// $events = get_the_terms( $post->ID, 'fwddc_events' );
// if ($events && ! is_wp_error( $events )) {
// 	foreach ($events as $event) {
// 		$post_classes[] = preg_replace('/[^A-Za-z0-9]/', '', $event->name);
// 	}
// }
?>
<article <?php post_class($post_classes); ?>>    
    <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
</article>