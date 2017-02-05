<?php
/**
 * Plugin Name:   Recipes
 * Plugin URI:    https://wordpress.org/plugins/recipes/
 * Description:   Recipes plugin with simplicity in mind.
 * Author:        Aristeides Stathopoulos
 * Author URI:    http://aristeides.com
 * Version:       1.2.0
 * Text Domain:   recipes
 * Domain Path:   /languages
 *
 * @package     Recipes
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 * @since       1.0
 */

/**
 * The main Recipes caller.
 * Instantiates the Recipes class
 * and sets the $recipes global var.
 *
 * @return object Recipes
 */
function recipes() {

	global $recipes;
	if ( ! $recipes ) {
		$recipes = new Recipes();
	}
	return $recipes;

}
recipes();

/**
 * The main Recipes class.
 */
class Recipes {

	/**
	 * The plugin path.
	 *
	 * @static
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public static $plugin_path;

	/**
	 * The templates path.
	 *
	 * @static
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public static $templates_path;

	/**
	 * The plugin URL.
	 *
	 * @static
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public static $plugin_url;

	/**
	 * Constructor.
	 */
	public function __construct() {

		// Set the object properties.
		self::$plugin_path    = plugin_dir_path( __FILE__ );
		self::$templates_path = wp_normalize_path( self::$plugin_path . '/templates/' );
		self::$plugin_url     = plugins_url( '', __FILE__ );

		// Include files.
		$this->includes();

		// Instantiate the metaboxes.
		new Recipes_Metabox_General_Info();
		new Recipes_Metabox_Ingredients();
		new Recipes_Metabox_Steps();
		new Recipes_Customizer();

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'template_include', array( $this, 'template_loader' ) );
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'attachment_image_attributes' ), 99, 3 );
		add_action( 'edit_form_after_title', array( $this, 'above_editor_metaboxes' ) );

	}

	/**
	 * Include all other files.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function includes() {

		require_once( self::$plugin_path . 'includes/post-type.php' );
		require_once( self::$plugin_path . 'includes/taxonomies.php' );
		require_once( self::$plugin_path . 'includes/class-recipes-metabox.php' );
		require_once( self::$plugin_path . 'includes/class-recipes-metabox-general-info.php' );
		require_once( self::$plugin_path . 'includes/class-recipes-metabox-ingredients.php' );
		require_once( self::$plugin_path . 'includes/class-recipes-metabox-steps.php' );
		require_once( self::$plugin_path . 'includes/customizer.php' );

	}

	/**
	 * Enqueue scripts & styles
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_scripts() {

		wp_enqueue_style( 'recipes', trailingslashit( self::$plugin_url ) . 'assets/css/styles.css', array( 'dashicons' ) );
		if ( true === get_theme_mod( 'recipes_steps_before_ingredients', false ) ) {
			wp_add_inline_style(
				'recipes',
				'.recipe.content .recipe-execution-wrapper > div.ingredients { order: 2; }'
			);
		}

	}


	/**
	 * Enqueue scripts & styles
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_enqueue_scripts() {

		global $post;
		if ( $post && is_object( $post ) && 'recipe' !== $post->post_type ) {
			return;
		}

		wp_enqueue_script( 'recipes', trailingslashit( self::$plugin_url ) . 'assets/js/recipes-admin.js', array( 'jquery', 'underscore', 'wp-util' ) );
		wp_enqueue_style( 'recipes-admin', self::$plugin_url . '/assets/css/admin-post-edit.css' );

	}

	/**
	 * Get template part (for templates like the shop-loop).
	 *
	 * @since 1.0.0
	 * @static
	 * @access public
	 * @param mixed  $slug The slug.
	 * @param string $name Default value: ''.
	 */
	public function get_template_part( $slug, $name = '' ) {

		$template = '';

		// Look in yourtheme/slug-name.php and yourtheme/recipes/slug-name.php.
		if ( $name ) {
			$template = locate_template( array(
				"{$slug}-{$name}.php",
				"recipes/{$slug}-{$name}.php",
			) );
		}

		// Get default slug-name.php.
		if ( ! $template && $name && file_exists( self::$templates_path . "{$slug}-{$name}.php" ) ) {
			$template = self::$templates_path . "{$slug}-{$name}.php";
		}

		// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/recipes/slug.php.
		if ( ! $template ) {
			$template = locate_template( array(
				"{$slug}.php",
				"recipes/{$slug}.php",
				self::$templates_path . "{$slug}.php",
			) );
		}

		// Allow 3rd party plugins to filter template file from their plugin.
		$template = apply_filters( 'recipes/get_template_part', $template, $slug, $name );

		if ( $template ) {
			load_template( $template, false );
		}

	}

	/**
	 * Load a template.
	 *
	 * Handles template usage so that we can use our own templates instead of the themes.
	 *
	 * Templates are in the 'templates' folder.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param mixed $template The template to load.
	 * @return string
	 */
	public function template_loader( $template ) {

		$find = array( 'recipes.php' );
		$file = '';

		if ( is_single() && 'recipe' === get_post_type() ) {

			$file 	= 'single-recipe.php';
			$find[] = 'recipes/' . $file;
			$find[] = self::$templates_path . $file;

		} elseif ( is_post_type_archive( 'recipe' ) ) {

			$file 	= 'archive-recipe.php';
			$find[] = 'recipes/' . $file;

		}

		if ( $file ) {
			$path = locate_template( array_unique( $find ) );
			if ( ! $path ) {
				$path = self::$templates_path . $file;
			}
		}

		if ( ! file_exists( $path ) ) {
			return $template;
		}

		return apply_filters( 'recipes/template_loader', $path );

	}

	/**
	 * Filter the list of attachment image attributes.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param array        $attr       Attributes for the image markup.
	 * @param WP_Post      $attachment Image attachment post.
	 * @param string|array $size       Requested size. Image size or array of width and height values.
	 * @return array
	 */
	public function attachment_image_attributes( $attr, $attachment, $size ) {

		global $post;
		if ( 'recipe' === $post->post_type ) {
			$attr['itemprop'] = 'image';
		}
		return apply_filters( 'recipes/attachment_image_attributes', $attr );

	}

	/**
	 * Move the "above-editor" meta boxes after the title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function above_editor_metaboxes() {

		// Get the globals.
		global $post, $wp_meta_boxes;

		// Output the "above-editor" meta boxes.
		do_meta_boxes( get_current_screen(), 'above-editor', $post );

		// Remove the initial "above-editor" meta boxes.
		unset( $wp_meta_boxes['post']['above-editor'] );

	}
}
