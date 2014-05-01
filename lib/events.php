<?php
function create_fwddc_event_post_type() {
	$labels = array(
		'name' => __( 'Events' ),
		'singular_name' => __( 'Event' ),
	);
	$supports = array(
		'title',
		'editor',
		'thumbnail',
		'comments',
		'revisions',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_name' => 'Events',
		'menu_position' => 7,
		'menu_icon' => 'dashicons-calendar',
		'has_archive' => true,
		'add_new_item' => __('Add New Event', 'roots'),
		'edit_item' => __('Edit Event', 'roots'),
		'new_item' => __('New Event', 'roots'),
		'view_item' => __('View Event', 'roots'),	
		'not_found' => __('No Events Found', 'roots'),
		'rewrite' => array('slug' => 'events'),
		'supports' => $supports,
		'capability_type' => 'post',
	);

	register_post_type( 'fwddc_event', $args);
}
add_action( 'init', 'create_fwddc_event_post_type' );

/**
 * Events Meta Boxes
 *   we need:
 *     title, date, brownpapertickets, facebook event page, 
 */
function add_events_meta_boxes( $post ) {
    add_meta_box( 'fwddc_event_fb', __('Facebook Event ID', 'roots'), 'fwddc_event_meta', 'fwddc_event', 'normal', 'default', array( 'name' => 'fb', 'prefix' => 'http://facebook.com/events/' ) );
    add_meta_box( 'fwddc_event_tix', __('Ticket Link', 'roots'), 'fwddc_event_meta', 'fwddc_event', 'normal', 'default', array( 'name' => 'tix', 'prefix' => '' ) );
    add_meta_box( 'fwddc_event_date', __('Event Date', 'roots'), 'fwddc_event_meta', 'fwddc_event', 'normal', 'default', array( 'name' => 'event_date', 'prefix' => '' ) );
}
add_action( 'add_meta_boxes', 'add_events_meta_boxes');

function fwddc_event_meta( $post, $meta_args ) {
    $name = $meta_args['args']['name'];
    $meta_prefix = 'fwddc_event_';
    $action = $meta_prefix.$name.'_meta_box';
    $nonce_name = $meta_prefix.$name.'_meta_box_nonce';
    $input_name = $meta_prefix.$name;
    wp_nonce_field( $action, $nonce_name );

    $val = get_post_meta( $post->ID, '_'.$input_name, TRUE );

    echo '<label for="'.$input_name.'">'.$meta_args['args']['prefix'].'</label><input type="text" name="'.$input_name.'" id="'.$input_name.'" value="'.$val.'" style="width: 50%;" />';
}

function fwddc_save_event_meta_box_data( $post_id ) { 

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    } 

    $meta_boxes = array(
        'fb',
        'tix',
        'event_date'
    );
    $meta_prefix = 'fwddc_event_';

    foreach ($meta_boxes as $box) {
    	$box_name = $meta_prefix.$box;
    	$meta_name = "_".$box_name;
        $action = $box_name.'_meta_box';
        $nonce = $action.'_nonce';
 
        if ( ! isset( $_POST[$nonce] ) ) {
            continue;
        }
        if ( ! wp_verify_nonce( $_POST[$nonce], $action ) ) {
            continue;
        }   
        if ( ! isset( $_POST[$box_name] ) ) {
            continue;
        }
        $meta_data = sanitize_text_field( $_POST[$box_name] );
        update_post_meta( $post_id, $meta_name, $meta_data );
    }
}
add_action( 'save_post', 'fwddc_save_event_meta_box_data' );

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


/**
 * Venues Taxonomy
 */
function register_fwddc_venues_taxonomy(){
	$labels = array (
        'name' 			=> _x( 'Venues', 'taxonomy general name', 'roots' ),
        'singular_name' => _x( 'Venue', 'taxonomy singular name', 'roots' ),
        'search_items' 	=> __( 'Search Venues', 'roots' ),
        'all_items' 	=> __( 'All Venues', 'roots' ),
        'edit_item' 	=> __( 'Edit Venue', 'roots'),
        'update_item' 	=> __( 'Update Venue', 'roots'),
        'add_new_item' 	=> __( 'Add New Venue', 'roots'),
		'new_item_name' => __( 'New Venue', 'roots'),
		'menu_name'		=> __( 'Venues', 'roots' ),
    );
	$args = array (
     	'labels' => $labels,
        'hierarchical' => false,
        'separate_items_with_commas' => __('Separate venues with commas'),
        'show_ui' => true,
        'show_tagcloud' => false, 
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'query_var' => 'venue',
        'rewrite' => array( 'slug' => 'venues' ),
        'public'=>true,
    );
    $post_types = array(
    	'fwddc_event',
    	'fwddc_venue',
    );
	register_taxonomy( 'fwddc_venues', $post_types, $args );
}
add_action('init', 'register_fwddc_venues_taxonomy');

/**
 * Populate the venues taxonomy with existing venues' names
 * so that they can be tagged to the event.
 **/
function populate_fwddc_venues_taxonomy(){
	/**
	 * The WordPress Query class.
	 * @link http://codex.wordpress.org/Function_Reference/WP_Query
	 *
	 */
	$q_args = array(
		//Type & Status Parameters
		'post_status' => 'publish',
		'post_type' => array(
			'fwddc_venue',
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
			if (!term_exists( $term, 'fwddc_venues' )) {
				wp_insert_term( $term, 'fwddc_venues', $args );
			}
		}
		wp_reset_postdata();
	}
}
add_action('admin_init','populate_fwddc_venues_taxonomy');