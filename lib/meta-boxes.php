<?php
function url_meta( $post ) {
	$url = get_post_meta( $post->ID, '_fwddc_url', TRUE );
	if ( ! $url ) $url = "";
	//include( get_template_part( 'templates/url-meta' ) );
	?>
	<input type="hidden" name="fwddc_url_noncename" id="fwddc_url_noncename" value="<?php echo wp_create_nonce( 'fwddc_url'.$post->ID );?>" />
	<input type="text" name="fwddc_url_text" id="fwddc_url_text" value="<?php echo $url ?>" />
	<?php
}

function fwddc_save_url_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['fwddc_url_noncename'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['fwddc_url_noncename'], 'fwddc_url' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, its safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['fwddc_url'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['fwddc_url'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_fwddc_url', $my_data );
}
