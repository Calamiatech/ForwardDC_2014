
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

$event_date = get_post_meta( $post->ID, '_fwddc_event_event_date_startdate', TRUE );
if ($event_date && ! is_wp_error( $event_date )) {
	$time = strtotime(str_replace('-', '/', $event_date));
	$date_code = date('Y-m-d',$time);
	$post_classes[] = $date_code;
	// $post_classes[] = preg_replace('/[^A-Za-z0-9]/', '', $event->name);

	$_event_date = new DateTime(str_replace('-', '/', $event_date));
	$datediff = $_event_date->diff(new DateTime());

	if ( $datediff->d < -1 ) {
		$post_classes[] = 'past';
		$post_classes = array_replace( $post_classes, array( 1 => 'col-sm-4' ) );
	} 
	elseif ( $datediff->d > 0 ) {
		$post_classes[] = 'upcoming';
		$happening = array(); // placeholder for selected class set.
		$happening_now = array(
				1 => "col-sm-12",
				2 => "col-md-12", 
				3 => "col-lg-12", 
				4 => "col-xl-6" 
			);
		$happening_soon = array(
				2 => 'col-md-8',
				3 => 'col-lg-6',
				4 => 'col-xl-4'
			);
		$happening_nextweek = array(
				2 => 'col-md-6',
				3 => 'col-lg-4',
				4 => 'col-xl-3'
			);
		if ( $datediff->d < 1 && $datediff->d > 0 ) {
			$post_classes[] = "happening-now";
			$happening = $happening_now;
		} elseif ( $datediff->d > 1 && $datediff->d < 2 ) {
			$post_classes[] = "happening-soon";
			$happening = $happening_soon;
		} elseif ( $datediff->d > 2 && $datediff->d < 7 ) {
			$post_classes[] = "happening-nextweek";
			$happening = $happening_nextweek;
		}

		$post_classes = array_replace($post_classes, $happening);

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
	<a href="<?php the_permalink(); ?>">
	    <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
	</a>
</article>