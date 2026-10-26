<?php
/**
* Plugin Name: S3 Uploads DigitalOcean Spaces
* Plugin URI: https://palebluedot.tv
* Description: Helper file to get DigitalOcean Spaces working with S3 Uploads
* Version: 1.0
* Author: Pale Blue Dot
* Author URI: https://palebluedot.tv
**/

// Filter S3 Uploads params.
add_filter( 's3_uploads_s3_client_params', function ( $params ) {
	if ( defined( 'S3_UPLOADS_ENDPOINT' ) ) {
		$params['endpoint'] = S3_UPLOADS_ENDPOINT;
		$params['use_path_style_endpoint'] = true;
		$params['debug'] = false; // Set to true if uploads are failing.
	}
	return $params;
}, 5, 1 );
