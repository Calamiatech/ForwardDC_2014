
<?php
/* Post Container Styles */
$post_classes = array(
	'event',
	
	'col-sm-6',
	'col-md-4',
	'col-lg-3',
	'col-xl-2',

	'isotope-ready',
	);

$event_date = get_post_meta( $post->ID, '_fwddc_event_date', TRUE );
if ($event_date && ! is_wp_error( $event_date )) {
	// $post_classes[] = preg_replace('/[^A-Za-z0-9]/', '', $event->name);
}

$event_years = get_the_terms( $post->ID, 'fwddc_event_year' );
if ( $event_years && ! is_wp_error( $event_years )) {
	foreach ($event_years as $year) {
		$post_classes[] = $year->name;
	}
}
?>

<article <?php post_class($post_classes); ?>>    
    <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
	<h4 class="eventName"><?php the_title(); ?>
	<?php if($soundcloud = get_post_meta( $post->ID, "_fwddc_soundcloud_url", TRUE ) ) : ?>
	<span class="soundcloud pull-right"><a class="glyphicon glyphicon-cloud" href="https://soundcloud.com/<?php echo $soundcloud ?>"></a></span>
	<?php endif ?>
	</h4>
</article>