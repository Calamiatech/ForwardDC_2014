<?php
add_action( 'init', 'create_venue_post_type' );

function create_venue_post_type() {
	$labels = array(
		'name' => __( 'Venues' ),
		'singular_name' => __( 'Venues' )
	);
	$support = array(
		'title',
		'editor',
		'thumbnail',
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_name' => 'Venues',
		'menu_position' => 8,
		'menu_icon' => 'dashicons-location-alt',
		'supports' => $support,
		'has_archive' => true,
		'add_new_item' => __('Add New Venue', 'root'),
		'edit_item' => __('Edit Venue', 'root'),
		'new_item' => __('New Venue', 'root'),
		'view_item' => __('View Venue', 'root'),
		'rewrite' => array('slug' => 'venues'),
	);

	register_post_type( 'fwddc_venue', $args);
}
?>