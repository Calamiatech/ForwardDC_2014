<section class="container-fluid">
	<div id="filters" class="row">
		<?php
		/* EVENT YEAR FILTER */ 
			$event_years_args = array(
				'orderby'	=> 'name',
				'order'		=> 'DESC',
				'hide_empty'=> false,
				);
			$event_years_list = get_terms( 'fwddc_event_year', $event_years_args );
			// Only show this filter if everything comes back AOK.
			if ( $event_years_list && ! is_wp_error( $event_years_list )) { 
		?>
		<div class="eventYearsFilter col-lg-3 col-xs-12 filterGroup" data-filter-group="event_years">
			<label for="event_years_FilterDropdown">Years</label>
			<select class="filter_dropdown col-lg-12" name="event_years_FilterDropdown" id="event_years_FilterDropdown">
				<option value="" selected="true">All</option>
				<?php
					foreach ($event_years_list as $event_year){
						$event_year_safe_name = preg_replace('/[^A-Za-z0-9]/', '', $event_year->name);
						echo '<option value=".'.$event_year_safe_name.'">'.$event_year->name.'</option>';
					}
				?>
			</select>
		</div>
		<?php
			}  /* END EVENT YEARS FILTER */
		?>
	</div>
  <div class="row js-isotope"
	id="events-container" 
    data-isotope-options='{ 
		"itemSelector": ".event", 
		"masonry": { 
			"columnWidth": ".event", 
			"gutter":0
		},
		"getSortData": {
			"eventName": ".eventName"
		},
		"filter":".2014",
		"sortBy":"eventName"
	}'>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/event', 'calendar'); ?>
<?php endwhile; ?>
  </div>
</section>
<?php echo '<h1>'.is_page_template('archive-fwddc_event.php' ).'</h1>'; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="next"><?php next_posts_link(__('Next <span class="glyphicon glyphicon-chevron-right"></span>', 'roots')); ?></li>
      <li class="previous"><?php previous_posts_link(__('<span class="glyphicon glyphicon-chevron-left"></span> Prev', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>