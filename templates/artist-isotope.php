
<?php
/* Post Container Styles */
$post_classes = array(
	'artist',
	
	'col-sm-6',
	'col-md-4',
	'col-lg-3',
	'col-xl-2',

	'isotope-ready',
	);
$size_multiple = 0.5;
$statuses = get_the_terms( $post->ID, 'fwddc_artist_status');
if ($statuses && ! is_wp_error( $statuses )) {
	foreach ($statuses as $status) {
		switch ($status) {
			case 'Headliner':
				$size_multiple *= 2;
				break;
			case 'Veteran':
				$size_multiple *= 1.5;
				break;
			case 'Local':
				$size_multiple *= .75;
			default:
				# code...
				break;
		}
	}
}	
$post_classes += array(
	'col-sm-'.ceil($size_multiple * 6),
	'col-md-'.ceil($size_multiple * 4 ),
	'col-lg-'.ceil($size_multiple * 3 ),
	'col-xl-'.ceil($size_multiple * 2 )
);

$genres = get_the_terms( $post->ID, 'fwddc_artist_genre' );
if ($genres && ! is_wp_error( $genres )) {
	foreach ($genres as $genre) {
		$post_classes[] = preg_replace('/[^A-Za-z0-9]/', '_', $genre->name);
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
	<h4 class="artistName"><?php the_title(); ?>
	<?php if($soundcloud = get_post_meta( $post->ID, "_fwddc_soundcloud_url", TRUE ) ) : ?>
	<span class="soundcloud pull-right"><a class="glyphicon glyphicon-cloud" href="https://soundcloud.com/<?php echo $soundcloud ?>"></a></span>
	<?php endif ?>
	</h4>
</article>