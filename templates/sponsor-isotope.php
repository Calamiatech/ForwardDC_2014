
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

$event_years = get_the_terms( $post->ID, 'fwddc_event_year' );
if ( $event_years && ! is_wp_error( $event_years )) {
	foreach ($event_years as $year) {
		$post_classes[] = $year->name;
	}
}
?>
<article <?php post_class($post_classes); ?>>   
	<?php if ($sponsor_url = get_post_meta($post->ID, '_fwddc_sponsor_url', TRUE)): ?>
		<?php $sponsor_url = fwddc_url($sponsor_url, 'http://'); ?>
	<a href="<?php echo $sponsor_url ?>" target="_blank">
	<?php endif ?>
    <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
	<?php if ($sponsor_url) : ?>
	</a>
	<?php endif ?>    
</article>