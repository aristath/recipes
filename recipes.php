<?php
/**
 * Plugin Name: Recipes
 * Plugin URI:  https://press.codes
 * Version:	    0.1.0
 * Text Domain: recipes
 */

define( 'RECIPES_PATH', plugin_dir_path( __FILE__ ) );
define( 'RECIPES_URL',  plugins_url( '', __FILE__ ) );

require_once( RECIPES_PATH . 'includes/post-type.php' );
require_once( RECIPES_PATH . 'includes/taxonomies.php' );
require_once( RECIPES_PATH . 'includes/class-recipes-metaboxes.php' );
require_once( RECIPES_PATH . 'includes/class-recipes-metaboxes-general-info.php' );
require_once( RECIPES_PATH . 'includes/class-recipes-metaboxes-ingredients.php' );
require_once( RECIPES_PATH . 'includes/class-recipes-admin-styles.php' );

require_once( RECIPES_PATH . 'includes/reviews/class-recipes-reviews.php' );
new Recipes_Reviews( 'recipe' );

require_once( RECIPES_PATH . 'includes/scripts.php' );
require_once( RECIPES_PATH . 'includes/customizer/customizer.php' );
require_once( RECIPES_PATH . 'includes/customizer/styles.php' );

// Instantiate the main plugin class
function recipes() {
	new Recipes_Admin_Styles();
	new Recipes_Metaboxes_General_Info();
	new Recipes_Metaboxes_Ingredients();
}
recipes();
