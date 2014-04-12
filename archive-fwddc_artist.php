<?php get_template_part('templates/page', 'header'); ?>

<section class="container-fluid">
	<div id="filters" class="row">
		<?php
		/* GENRES FILTER */ 
			$genres_args = array(
				'orderby'	=> 'name',
				'order'		=> 'ASC',
				);
			$genres_list = get_terms( 'fwddc_artist_genre', $genres_args );
			// Only show this filter if everything comes back AOK.
			if ( $genres_list && ! is_wp_error( $genres_list )) { 
		?>
		<div class="genresFilter col-lg-3 col-xs-12 filterGroup" data-filter-group="genres">
			<label for="genresFilterDropdown">Genres</label>
			<select class="filter_dropdown" name="genresFilterDropdown" id="genresFilterDropdown">
				<option value="" selected="true">All</option>
				<?php
					foreach ($genres_list as $genre){
						$genre_safe_name = str_replace(' ', '_', $genre->name);
						echo '<option value=".'.$genre_safe_name.'">'.$genre->name.'</option>';
					}
				?>
			</select>
		</div>
		<?php
			}  /* END GENRES FILTER */
		?>
		<?php
		/* EVENTS FILTER */ 
			$events_args = array(
				'orderby'	=> 'name',
				'order'		=> 'ASC',
				'hide_empty'=> false,
				);
			$events_list = get_terms( 'fwddc_events', $events_args );
			// Only show this filter if everything comes back AOK.
			if ( $events_list && ! is_wp_error( $events_list )) { 
		?>
		<div class="eventsFilter col-lg-3 col-xs-12 filterGroup" data-filter-group="events">
			<label for="eventsFilterDropdown">Events</label>
			<select class="filter_dropdown" name="eventsFilterDropdown" id="eventsFilterDropdown">
				<option value="" selected="true">All</option>
				<?php
					foreach ($events_list as $event){
						$event_safe_name = preg_replace('/[^A-Za-z0-9]/', '', $event->name);
						echo '<option value=".'.$event_safe_name.'">'.$event->name.'</option>';
					}
				?>
			</select>
		</div>
		<?php
			}  /* END EVENTS FILTER */
		?>
	</div>
  <div class="row js-isotope"
	id="artists-container" 
    data-isotope-options='{ 
		"itemSelector": ".artist", 
		"masonry": { 
			"columnWidth": ".artist", 
			"gutter":0
		},
		"getSortData": {
			"artistName": ".artistName"
		},
		"sortBy":"artistName"
	}'>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/artist', 'isotope'); ?>
<?php endwhile; ?>
  </div>
</section>
<?php echo '<h1>'.is_page_template('archive-fwddc_artist.php' ).'</h1>'; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="next"><?php next_posts_link(__('Next <span class="glyphicon glyphicon-chevron-right"></span>', 'roots')); ?></li>
      <li class="previous"><?php previous_posts_link(__('<span class="glyphicon glyphicon-chevron-left"></span> Prev', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
