<?php
add_action( 'init', 'create_sponsor_post_type' );

function create_sponsor_post_type() {
	$labels = array(
		'name' => __( 'Sponsors' ),
		'singular_name' => __( 'Sponsor' )
	);
	$support = array(
		'title',
		'editor',
		'thumbnail',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_name' => 'Sponsors',
		'menu_position' => 9,
		'menu_icon' => 'dashicons-awards',
		'has_archive' => true,
		'supports' => $support,
		'add_new_item' => __("Add New Sponsor", 'root'),
		'edit_item' => __('Edit Sponsor', 'root'),
		'new_item' => __('New Sponsor', 'root'),
		'view_item' => __('View Sponsor', 'root'),
		'rewrite' => array('slug' => 'sponsors'),
	);

	register_post_type( 'fwddc_sponsor', $args );
}
