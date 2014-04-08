<?php
/**
 * Year Taxonomy
 */

function register_fwddc_event_year_taxonomy() {
	$labels = array (
        'name' 			=> _x( 'ForwardDC Event Editions', 'taxonomy general name', 'roots' ),
        'singular_name' => _x( 'Event Year', 'taxonomy singular name', 'roots' ),
        'search_items' 	=> __( 'Search Event Editions', 'roots' ),
        'all_items' 	=> __( 'All Event Editions', 'roots' ),
        'edit_item' 	=> __( 'Edit Event Year', 'roots'),
        'update_item' 	=> __( 'Update Event Year', 'roots'),
        'add_new_item' 	=> __( 'Add New Event Year', 'roots'),
		'new_item_name' => __( 'New Event Edition', 'roots'),
		'menu_name'		=> __( 'Event Edition Years', 'roots' ),
    );
	$args = array (
     	'labels' => $labels,
        'hierarchical' => false,
        'separate_items_with_commas' => __('Separate years with commas'),
        'show_ui' => true,
        'show_tagcloud' => false, 
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'query_var' => 'year',
        'rewrite' => array( 'slug' => 'year' ),
        'public'=>true
    );
    $post_types = array(
    	'fwddc_artist',
    	'fwddc_sponsor',
    	'fwddc_venue',
    	'fwddc_event'
	);
	register_taxonomy('fwddc_event_year', $post_types , $args );
}
add_action('init', 'register_fwddc_event_year_taxonomy');

