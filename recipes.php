<?php
/**
 * Plugin Name: Recipes
 * Plugin URI:  https://press.codes
 * Version:	    0.1.0
 * Text Domain: recipes
 */

define( 'RECIPES_PATH', plugin_dir_path( __FILE__ ) );
define( 'RECIPES_URL',  plugins_url( '', __FILE__ ) );

function recipes_include_acf() {
	if ( ! class_exists( 'acf' ) ) {
		require_once( RECIPES_PATH . 'includes/advanced-custom-fields-pro/acf.php' );
	}
}
add_action( 'plugins_loaded', 'recipes_include_acf' );

require_once( RECIPES_PATH . 'includes/post-type.php' );
require_once( RECIPES_PATH . 'includes/taxonomies.php' );
require_once( RECIPES_PATH . 'includes/fields-acf.php' );
require_once( RECIPES_PATH . 'includes/class-recipes.php' );
require_once( RECIPES_PATH . 'includes/class-recipes-metaboxes.php' );
require_once( RECIPES_PATH . 'includes/class-recipes-admin-styles.php' );

require_once( RECIPES_PATH . 'includes/reviews/class-recipes-reviews.php' );
new Recipes_Reviews( 'recipe' );

require_once( RECIPES_PATH . 'includes/scripts.php' );
require_once( RECIPES_PATH . 'includes/customizer/customizer.php' );
require_once( RECIPES_PATH . 'includes/customizer/styles.php' );

// Instantiate the main plugin class
function recipes() {
	$recipes = new Recipes();
	$recipes->admin_styles = new Recipes_Admin_Styles();
    new Recipes_Metaboxes();
}
recipes();

function recipes_get_template_part( $template ) {

	if ( '' != locate_template( $template . '.php' ) ) {
		$file = locate_template( $template . '.php' );
	} else {
		$file = RECIPES_PATH . '/templates/' . $template . '.php';
	}

	if ( file_exists( $file ) ) {
		load_template( $file );
	}

}

function recipes_single_recipe_content( $content ) {
	global $post;

	// Are we on a recipe?
	// Does the user have a template file for content-recipe in their theme?
	if ( ! is_singular( 'recipe' ) ) {
		return $content;
	}

	recipes_get_template_part( 'content-recipe' );

}
add_filter( 'the_content', 'recipes_single_recipe_content' );

function recipes_get_option( $option = '' ) {

	if ( '' == $option ) {
		return null;
	}

	$default_options = array(
		'display_featured_image' => '1',
		'display_description'	=> '1',
		'display_rating'		 => '1',
		'display_author'		 => '1',
		'display_date'		   => '1',
	);
	$options = wp_parse_args( get_option( 'recipes', array() ), $default_options );

	if ( ! isset( $options[ $option ] ) ) {
		return null;
	}

	return $options[ $option ];

}

function recipes_recipe_excerpt( $excerpt ) {

	global $post;

	if ( 'recipe' != $post->post_type ) {
		return $content;
	}

	recipes_get_template_part( 'content-recipe-excerpt' );

}
add_filter( 'get_the_excerpt', 'recipes_recipe_excerpt' );
