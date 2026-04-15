<?php
/**
 * Main template file (Fallback Redirect)
 *
 * This file is required by WordPress but will redirect to the Headless Frontend.
 */

$frontend_url = 'http://localhost:3000'; // Define the Next.js frontend URL

if ( ! is_admin() && ! wp_is_json_request() ) {
	wp_redirect( $frontend_url, 301 );
	exit;
}
