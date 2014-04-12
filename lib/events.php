<?php
add_action( 'init', 'create_event_post_type' );

function create_event_post_type() {
	$labels = array(
		'name' => __( 'Events' ),
		'singular_name' => __( 'Event' ),
	);
	$supports = array(
		'title',
		'editor',
		'revisions',
		'custom-fields',
		'comments',
		'revisions',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_position' => 7,
		'menu_icon' => 'dashicons-calendar',
		'has_archive' => true,
		'hierarchical' => true,
		'add_new_item' => __('Add New Event', 'roots'),
		'edit_item' => __('Edit Event', 'roots'),
		'new_item' => __('New Event', 'roots'),
		'view_item' => __('View Event', 'roots'),	
		'rewrite' => array('slug' => 'events'),
		'supports' => $supports,
		'capability_type' => 'post',
	);

	register_post_type( 'fwddc_event', $args);
}

/**
 * Events Meta Boxes
 *   we need:
 *     title, date, venue, cost, brownpapertickets
 */
// function add_events_meta_boxes( $post ) {
// 	add_meta_box( 'fwddc_event_date', __('Event Date', 'roots'), 'date_meta', 'events', 'normal' );
// 	add_meta_box( 'fwddc_event_venue', __('Event Venue','roots'), 'venue_meta', 'events', 'normal' );
// }
// add_action( 'add_meta_boxes_events', 'add_events_boxes', 10, 2);

/**
 * Artists Taxonomy
 */
function register_fwddc_artists_taxonomy(){
	$labels = array (
        'name' 			=> _x( 'Artists', 'taxonomy general name', 'roots' ),
        'singular_name' => _x( 'Artist', 'taxonomy singular name', 'roots' ),
        'search_items' 	=> __( 'Search Artists', 'roots' ),
        'all_items' 	=> __( 'All Artists', 'roots' ),
        'edit_item' 	=> __( 'Edit Artist', 'roots'),
        'update_item' 	=> __( 'Update Artist', 'roots'),
        'add_new_item' 	=> __( 'Add New Artist', 'roots'),
		'new_item_name' => __( 'New Artist', 'roots'),
		'menu_name'		=> __( 'Artists', 'roots' ),
    );
	$args = array (
     	'labels' => $labels,
        'hierarchical' => false,
        'separate_items_with_commas' => __('Separate artists with commas'),
        'show_ui' => true,
        'show_tagcloud' => false, 
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'query_var' => 'artist',
        'rewrite' => array( 'slug' => 'artists' ),
        'public'=>true,
    );
    $post_types = array(
    	'fwddc_event',
    	'fwddc_venue',
    );
	register_taxonomy( 'fwddc_artists', $post_types, $args );
}
add_action('init', 'register_fwddc_artists_taxonomy');

/**
 * Populate the artists taxonomy with existing artists' names
 * so that they can be tagged to the event.
 **/
function populate_fwddc_artists_taxonomy(){
	/**
	 * The WordPress Query class.
	 * @link http://codex.wordpress.org/Function_Reference/WP_Query
	 *
	 */
	$q_args = array(
		//Type & Status Parameters
		'post_status' => 'any',
		'post_type' => array(
			'fwddc_artist',
			),
		//Order & Orderby Parameters
		'order'               => 'ASC',
		'orderby'             => 'name',
		'ignore_sticky_posts' => false,

		//Pagination Parameters
		'posts_per_page'         => -1,
		'nopaging'               => true,

		//Permission Parameters -
		'perm' => 'readable',
		
		//Parameters relating to caching
		'cache_results'          => true,
		'update_post_term_cache' => true,
		'update_post_meta_cache' => true,
	);
	
	$query = new WP_Query( $q_args );
	if ($query->have_posts()){
		$args = array();
		while ($query->have_posts()){
			$query->the_post();
			$term = get_the_title();
			if (!term_exists( $term, 'fwddc_artists' )) {
				wp_insert_term( $term, 'fwddc_artists', $args );
			}
		}
		wp_reset_postdata();
	}
}
add_action('admin_init','populate_fwddc_artists_taxonomy');