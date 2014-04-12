
<article <?php post_class(array('artist', 'col-sm-6','col-md-4','col-lg-2','isotope-ready')); ?>>    
	<div id="artist-content">
		<h4 class="entry-title"><?php the_title(); ?></h4>
	    <?php the_post_thumbnail('large',array('class'=>'img-responsive')); ?>
	</div>
</article>