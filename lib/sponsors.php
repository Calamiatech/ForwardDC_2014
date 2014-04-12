<?php
add_action( 'init', 'create_sponsor_post_type' );

function create_sponsor_post_type() {
	$labels = array(
		'name' => __( 'Sponsors' ),
		'singular_name' => __( 'Sponsor' )
	);
	$support = array(
		'title',
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

/**
 * Sponsors Meta Boxes
 *   we need:
 *     title, thumbnail, url 
 */
function add_sponsors_meta_boxes( $post ) {
	add_meta_box( 'fwddc_sponsor_url', __('Sponsor Website','roots'), 'fwddc_sponsor_url_meta', 'fwddc_sponsor', 'normal' );
}
add_action( 'add_meta_boxes', 'add_sponsors_meta_boxes', 10, 2);

function fwddc_sponsor_url_meta( $post ) {
	wp_nonce_field( 'fwddc_sponsor_url_meta_box', 'fwddc_sponsor_url_meta_box_nonce' );

	$url = get_post_meta( $post->ID, '_fwddc_sponsor_url', TRUE );
	if ( ! $url ) {
		$url = "http://";
	}
	//include( get_template_part( 'templates/url-meta' ) );
	?>
	<input type="text" name="fwddc_sponsor_url" id="fwddc_sponsor_url" value="<?php echo $url ?>" style="width: 100%;" />
	<?php
}

function fwddc_save_sponsor_url_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['fwddc_sponsor_url_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['fwddc_sponsor_url_meta_box_nonce'], 'fwddc_sponsor_url_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	/* OK, its safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['fwddc_sponsor_url'] ) ) {
		return;
	}

	// Prevent default from appearing
	if ($_POST['fwddc_sponsor_url'] == "http://") {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['fwddc_sponsor_url'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_fwddc_sponsor_url', $my_data );
}

add_action( 'save_post', 'fwddc_save_sponsor_url_meta_box_data' );
