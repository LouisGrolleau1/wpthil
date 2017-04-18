<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

define( 'WP_ROCKET_ADVANCED_CACHE', true );
$rocket_cache_path = '/web/ahcasso/www/wp-content/cache/wp-rocket/';
$rocket_config_path = '/web/ahcasso/www/wp-content/wp-rocket-config/';

if ( file_exists( '/web/ahcasso/www/wp-content/plugins/wp-rocket/inc/front/process.php' ) ) {
	include( '/web/ahcasso/www/wp-content/plugins/wp-rocket/inc/front/process.php' );
} else {
	define( 'WP_ROCKET_ADVANCED_CACHE_PROBLEM', true );
}