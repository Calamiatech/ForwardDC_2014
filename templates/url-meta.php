<input type="hidden" name="url_noncename" id="url_noncename" value="<?php echo wp_create_nonce( 'url'.$post->ID );?>" />
<input type="text" name="url_text" id="url_text" value="<?php echo $url ?>" />