<?php
/**
 * Plugin Name:       Maera Recipes
 * Plugin URI:        https://press.codes
 * Version:           0.1.0
 * Text Domain:       maera-recepes
 * Domain Path:       /languages/
 */

 define( 'MAERA_RECIPES_PATH', plugin_dir_path( __FILE__ ) );
 define( 'MAERA_RECIPES_URL',  plugins_url( '', __FILE__ ) );

 require_once( MAERA_RECIPES_PATH . 'includes/post-type.php' );
 require_once( MAERA_RECIPES_PATH . 'includes/taxonomies.php' );
 require_once( MAERA_RECIPES_PATH . 'includes/fields-acf.php' );
 require_once( MAERA_RECIPES_PATH . 'includes/class-maera-recipes-template.php' );
 require_once( MAERA_RECIPES_PATH . 'includes/scripts.php' );
 require_once( MAERA_RECIPES_PATH . 'includes/customizer.php' );

 $single_recipe_template = new Maera_Recipes_Template();
