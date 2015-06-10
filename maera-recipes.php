<?php
/**
 * Plugin Name:       Maera Recipes
 * Plugin URI:        https://press.codes
 * Version:           0.1.0
 * Text Domain:       maera-recipes
 * Domain Path:       /languages/
 */

define( 'MAERA_RECIPES_PATH', plugin_dir_path( __FILE__ ) );
define( 'MAERA_RECIPES_URL',  plugins_url( '', __FILE__ ) );

function maera_recipes_include_acf() {
    if ( ! class_exists( 'acf' ) ) {
        require_once( MAERA_RECIPES_PATH . 'includes/advanced-custom-fields-pro/acf.php' );
    }
}
add_action( 'plugins_loaded', 'maera_recipes_include_acf' );

require_once( MAERA_RECIPES_PATH . 'includes/post-type.php' );
require_once( MAERA_RECIPES_PATH . 'includes/taxonomies.php' );
require_once( MAERA_RECIPES_PATH . 'includes/fields-acf.php' );
require_once( MAERA_RECIPES_PATH . 'includes/class-maera-recipes.php' );
require_once( MAERA_RECIPES_PATH . 'includes/class-maera-recipes-admin-styles.php' );

require_once( MAERA_RECIPES_PATH . 'includes/reviews/class-maera-recipes-reviews.php' );
new Maera_Recipes_Reviews( 'recipe' );

require_once( MAERA_RECIPES_PATH . 'includes/scripts.php' );
require_once( MAERA_RECIPES_PATH . 'includes/customizer/customizer.php' );
require_once( MAERA_RECIPES_PATH . 'includes/customizer/styles.php' );

/**
 * Instantiate the main plugin class
 */
function Maera_Recipes() {
    $recipes = new Maera_Recipes();
    $recipes->admin_styles = new Maera_Recipes_Admin_Styles();
}
Maera_Recipes();

function maera_recipes_get_template_part( $template ) {

    if ( '' != locate_template( $template . '.php' ) ) {
        $file = locate_template( $template . '.php' );
    } else {
        $file = MAERA_RECIPES_PATH . '/templates/' . $template . '.php';
    }

    if ( file_exists( $file ) ) {
        load_template( $file );
    }

}

function maera_recipes_single_recipe_content( $content ) {
    global $post;

    // Are we on a recipe?
    // Does the user have a template file for content-recipe in their theme?
    if ( ( 'recipe' != $post->post_type ) ) {
        return $content;
    }

    maera_recipes_get_template_part( 'content-recipe' );

}
add_filter( 'the_content', 'maera_recipes_single_recipe_content' );

function maera_recipes_get_option( $option = '' ) {

    if ( '' == $option ) {
        return null;
    }

    $default_options = array(
        'display_featured_image' => '1',
        'display_description'    => '1',
        'display_rating'         => '1',
        'display_author'         => '1',
        'display_date'           => '1',
    );
    $options = wp_parse_args( get_option( 'maera_recipes', array() ), $default_options );

    if ( ! isset( $options[$option] ) ) {
        return null;
    }

    return $options[$option];

}
