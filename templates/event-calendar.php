
<?php
/* Post Container Styles */
$default_sm = 6;
$default_md = 4;
$default_lg = 3;
$default_xl = 2;

$post_classes = array(
	'event',
	
	'col-sm-'.$default_sm,
	'col-md-'.$default_md,
	'col-lg-'.$default_lg,
	'col-xl-'.$default_xl,
	
	'isotope-ready',
	);

$event_date = get_post_meta( $post->ID, '_fwddc_event_event_date_startdate', TRUE );
$_event_date = 0;
$past_event = FALSE;
$datecode = 999999999;

if ((!empty($event_date)) && (! is_wp_error( $event_date ))) {

	$_event_date = new DateTime(str_replace('-', '/', $event_date));
	$d = $_event_date->diff(new DateTime());
	$datediff = $d->d;
	$datecode = $_event_date->format('Ymd');

	if ( $_event_date > new DateTime() ) {
	// Event is in the future...
		$post_classes[] = "upcoming";

		if ($datediff > 0) {
			$post_classes[] = "happening_soon";
			$size_sm = 12 - ( 12 - $datediff < $default_sm ? $default_sm : $datediff );
			$size_md = 8 - ( 8 - $datediff < $default_md ? $default_md : $datediff );
			$size_lg = 6 - ( 6 - $datediff < $default_lg ? $default_lg : $datediff );
			$size_xl = 4 - ( 4 - $datediff < $default_xl ? $default_xl : $datediff );
			$post_classes = array_replace( $post_classes, array(
				1 => 'col-sm-'.$size_sm,
				2 => 'col-md-'.$size_md,
				3 => 'col-lg-'.$size_lg,
				4 => 'col-xl-'.$size_xl
				));
		} 
		elseif ($datediff == 0) {
		// Event happening NOW!
			$post_classes[] = "happening_now";
			$post_classes = array_replace($post_classes, array(
				1 => "col-sm-12",
				2 => "col-md-12", 
				3 => "col-lg-12", 
				4 => "col-xl-12" 
				));
		}
	} 
	else {
	// Event is in the past...
		$past_event = TRUE;
		$datecode = "9".$datecode;
		$post_classes[] = "past_event";
		$post_classes = array_replace( 
			$post_classes, 
			array( 
				1 => 'col-sm-4',
				2 => 'col-md-2',
				3 => 'col-lg-2',
				4 => 'col-xl-1' 
		) );
	}
}

$event_years = get_the_terms( $post->ID, 'fwddc_event_year' );
if ( $event_years && ! is_wp_error( $event_years )) {
	foreach ($event_years as $year) {
		$post_classes[] = $year->name;
	}
}

$event_tix_link = get_post_meta( $post->ID, "_fwddc_event_tix", TRUE );
$event_tix_price = get_post_meta( $post->ID, '_fwddc_event_tix_price', TRUE );
$event_fb_link = get_post_meta( $post->ID, '_fwddc_event_fb', TRUE );
?>

<article <?php post_class($post_classes); ?> data-event-date="<?php echo $datecode ?>">    

		<?php if (!$past_event): ?>
		<header>
			<h4 class="eventDate pull-left"><?php echo $_event_date ? $_event_date->format('m/d') : "" ?></h4>
			<?php if ($event_tix_link): ?>
			<h4 class="buytickets pull-right"><a href="<?php echo $event_tix_link ?>"><i class="fa fa-ticket fa-lg pull-right"></i></a></h5>
			<?php endif /* end event tix link check */ ?>
			<?php if ($event_fb_link): ?>
			<h4 class="fb_link pull-right"><a href="http://facebook.com/events/<?php echo $event_fb_link ?>"><i class="fa fa-facebook-square pull-right"></i></a></h5>
			<?php endif /* end fb link check */ ?>
			<?php if ($event_tix_price): ?>
			<h5 class="tix-price pull-right"><i class="fa fa-dollar"></i><?php echo $event_tix_price ?></h5>
			<?php endif /* end tix price check */ ?>
		</header>
		<?php endif /* end past event check */ ?>
		<main>
			<a href="<?php the_permalink(); ?>"	>
			   <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
			</a>
		</main>
</article>