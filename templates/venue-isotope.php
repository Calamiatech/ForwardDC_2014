
<?php
/* Post Container Styles */
$post_classes = array(
	'venue',
	
	'col-sm-6',
	'col-md-4',
	'col-lg-3',
	'col-xl-2',

	'isotope-ready',
	);

$genres = get_the_terms( $post->ID, 'fwddc_artist_genre' );
if ($genres && ! is_wp_error( $genres )) {
	foreach ($genres as $genre) {
		$post_classes[] = str_replace(' ', '_', $genre->name);
	}
}
$events = get_the_terms( $post->ID, 'fwddc_events' );
if ($events && ! is_wp_error( $events )) {
	foreach ($events as $event) {
		$post_classes[] = preg_replace('/[^A-Za-z0-9]/', '', $event->name);
	}
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
</article>