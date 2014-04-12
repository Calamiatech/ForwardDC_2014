<?
function url_meta($post) {
	$url = get_post_meta($post->ID, '_url', TRUE);
	if (!$url) $url = "";
	include(get_template_part('templates/url-meta'));
}