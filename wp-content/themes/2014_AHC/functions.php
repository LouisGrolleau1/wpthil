<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
/*include (ABSPATH.'wp-content/themes/AHC Full/my_own_functions.php');*/
require_once( get_stylesheet_directory(). '/my_own_functions.php' );
