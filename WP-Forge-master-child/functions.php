<?php
/**
 * WP-Starter functions and definitions.
 *
 * A blank functions.php file to add your own functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since WP-Starter 1.0
 */

/**
 * Setup WP-Starter Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function wpstarter_theme_setup() {
	load_child_theme_textdomain( 'wpstarter', get_stylesheet_directory() . '/language' );
}
add_action( 'after_setup_theme', 'wpstarter_theme_setup' );

/**
 * Load PressTrends to track the usage of WP-Starter across the web, You can comment this line if you don't want to be tracked
 *
 * @see http://presstrends.io/
 *
 * @since WP-Starter 1.0
 */
require( get_stylesheet_directory() . '/inc/wpstarterpt.php' );

// LESS 

function badass_enqueue_less() {
  wp_enqueue_style('badass-less', get_stylesheet_directory_uri().'/less/badass.less');
}


add_action('wp_enqueue_scripts', 'badass_enqueue_less', 50);

function badass_enqueue_js() {
  wp_enqueue_script( 'badass-js', get_stylesheet_directory_uri() . '/js/badass.js', array(), '', true);
  wp_enqueue_script( 'badass-js-orbit', get_stylesheet_directory_uri() . '/js/badass-orbit.js', array(), '', true);
}

add_action( 'wp_enqueue_scripts', 'badass_enqueue_js', 50 );

?>