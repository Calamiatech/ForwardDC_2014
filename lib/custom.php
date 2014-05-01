<?php
/**
 * ForwardDC includes
 */
require_once locate_template('/lib/artists.php');		// Custom "Artists" content type
require_once locate_template('/lib/events.php');		// Custom "Events" content type
require_once locate_template('/lib/sponsors.php');		// Custom "Sponsors" content type
require_once locate_template('/lib/venues.php');		// Custom "Venues" content type
require_once locate_template('/lib/event_year.php');	// Taxonomy for Event Year, in order to filter by editions of the event

/*********************************************************
 * fwddc_url function
 * params:	$url    : string to be sanitized
 * 			$prefix : (optional) string to prefix sanitized
 *                     url with
 * returns: (string) sanitized url
 *********************************************************/

function fwddc_url($url, $prefix = "http://") {
	$url = trim($url, '/');

	// If scheme not included, prepend it
	if (!preg_match('#^http(s)?://#', $url)) {
	    $url = $prefix . $url;
	}

	return $url;
}