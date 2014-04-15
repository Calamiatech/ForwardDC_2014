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
        'hierarchical' => true,
		'has_archive' => true,
		'add_new_item' => __('Add New Venue', 'root'),
		'edit_item' => __('Edit Venue', 'root'),
		'new_item' => __('New Venue', 'root'),
		'view_item' => __('View Venue', 'root'),
		'rewrite' => array('slug' => 'venues'),
	);

	register_post_type( 'fwddc_venue', $args);
}

/**
 * Venues Meta Boxes
 *  we need:
 *      title, thumbnail, url, address
**/
function add_venues_meta_boxes( $post ) {
    add_meta_box( 'fwddc_venue_url', __('Venue\'s Web Page', 'roots'), 'fwddc_venue_meta', 'fwddc_venue', 'normal', 'default', array( 'name' => 'url', 'prefix' => 'http://' ) );
    add_meta_box( 'fwddc_venue_address', __('Venue Address', 'roots'), 'fwddc_venue_meta', 'fwddc_venue', 'normal', 'default', array( 'name' => 'address', 'prefix' => '' ) );
}
add_action( 'add_meta_boxes', 'add_venues_meta_boxes');

function fwddc_venue_meta( $post, $meta_name ) {
    $name = $meta_name['args']['name'];
    $action = 'fwddc_venue_'.$name.'_meta_box';
    $nonce_name = 'fwddc_venue_'.$name.'_meta_box_nonce';
    $input_name = 'fwddc_'.$name;
    wp_nonce_field( $action, $nonce_name );

    $text = get_post_meta( $post->ID, '_'.$input_name, TRUE );

    echo '<label for="'.$input_name.'">'.$meta_name['args']['prefix'].'</label><input type="text" name="'.$input_name.'" id="'.$input_name.'" value="'.$text.'" style="width: 80%;" />';
}

function fwddc_save_venue_meta_box_data( $post_id ) { 

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    } 

    $meta_boxes = array(
        'url',
        'address'
    );

    foreach ($meta_boxes as $box) {
        $action = 'fwddc_venue_'.$box.'_meta_box';
        $nonce = $action.'_nonce';
 
        if ( ! isset( $_POST[$nonce] ) ) {
            continue;
        }
        if ( ! wp_verify_nonce( $_POST[$nonce], $action ) ) {
            continue;
        }   
        if ( ! isset( $_POST['fwddc_'.$box] ) ) {
            continue;
        }
        $meta_data = sanitize_text_field( $_POST['fwddc_'.$box] );
        update_post_meta( $post_id, '_fwddc_'.$box, $meta_data );
    }
}
add_action( 'save_post', 'fwddc_save_venue_meta_box_data' );


