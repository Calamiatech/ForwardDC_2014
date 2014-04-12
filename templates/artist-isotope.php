
<?php
/* Post Container Styles */
$post_classes = array(
	'artist',
	
	'col-sm-6',
	'col-md-4',
	'col-lg-2',

	'isotope-ready',
	);

$genres = get_the_terms( $post->ID, 'fwddc_artist_genre' );
if ($genres && ! is_wp_error( $genres )) {
	foreach ($genres as $genre) {
		$post_classes[] = $genre->name;
	}
}
?>
<article <?php post_class($post_classes); ?>>    
	<div id="artist-content">
	    <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
		<h4 class="artist-name"><?php the_title(); ?></h4>
	</div>
</article>