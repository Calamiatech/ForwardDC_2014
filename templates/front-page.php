
<header class="jumbotron container-fluid hero ">
	<section class="row">
		<div class="alert alert-danger col-lg-12"><a class="btn-lg" href="http://forward2014.bpt.me">Get Forward 2014 Festival Passes Now!</a></div>
		<div class="col-lg-7 hidden-md hidden-sm hidden-xs" id="hero_container">
			<img src="/wp-content/themes/roots/assets/img/perspective_ball.png" id="p_ball" class="img_responsive" class="animatable">
			<img src="/wp-content/themes/roots/assets/img/red_arrow_spikes_in_formation.png" id="spike_formation" class="animatable">
		</div>
	</section>

</header>

<section class="container pullup" role="document">
	<div class="frontpage col-sm-12 col-lg-8 col-lg-offset-3 col-md-offset-0 col-sm-offset-0">
		<?php
 $postslist = get_posts('numberposts=10');
 foreach ($postslist as $post) :
    setup_postdata($post);
 ?>
        <div class="post"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php the_content() ?>
<hr />
</div>
<?php endforeach ?>
	</div>
</section>