<?php
/**
 * Plugin Name: Recipes
 * Plugin URI:  https://press.codes
 * Version:	    0.1.0
 * Text Domain: recipes
 */

function recipes() {
	global $recipes;
	if ( ! $recipes ) {
		$recipes = new Recipes();
	}
	return $recipes;
}
recipes();

class Recipes {

	/**
	 * The plugin path.
	 *
	 * @access protected
	 * @var string
	 */
	protected $plugin_path;

	/**
	 * The templates path.
	 *
	 * @access protected
	 * @var string
	 */
	protected $templates_path;

	/**
	 * The plugin URL.
	 *
	 * @access protected
	 * @var string
	 */
	protected $plugin_url;

	/**
	 * Constructor.
	 */
	public function __construct() {

		// Set the object properties
		$this->plugin_path    = plugin_dir_path( __FILE__ );
		$this->templates_path = wp_normalize_path( $this->plugin_path . '/templates/' );
		$this->plugin_url     = plugins_url( '', __FILE__ );

		// Include files
		$this->includes();

		// Instantiate the metaboxes.
		new Recipes_Metabox_General_Info();
		new Recipes_Metabox_Ingredients();

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'template_include', array( $this, 'template_loader' ) );

	}

	/**
	 * Include all other files.
	 *
	 * @access private
	 */
	private function includes() {
		require_once( $this->plugin_path . 'includes/post-type.php' );
		require_once( $this->plugin_path . 'includes/taxonomies.php' );
		require_once( $this->plugin_path . 'includes/class-recipes-metabox.php' );
		require_once( $this->plugin_path . 'includes/class-recipes-metabox-general-info.php' );
		require_once( $this->plugin_path . 'includes/class-recipes-metabox-ingredients.php' );
	}

	/**
	 * Enqueue scripts & styles
	 *
	 * @access public
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'recipes', trailingslashit( $this->plugin_url ) . 'assets/css/styles.css' );
	}


	/**
	 * Enqueue scripts & styles
	 *
	 * @access public
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'recipes', trailingslashit( $this->plugin_url ) . 'assets/js/recipes-admin.js', array( 'jquery' ) );
		wp_enqueue_style( 'recipes-admin', $this->plugin_url . '/assets/css/admin-post-edit.css' );
	}

	/**
	 * Get template part (for templates like the shop-loop).
	 *
	 * @static
	 * @access public
	 * @param mixed $slug
	 * @param string $name (default: '')
	 */
	public function get_template_part( $slug, $name = '' ) {
		$template = '';

		// Look in yourtheme/slug-name.php and yourtheme/recipes/slug-name.php
		if ( $name ) {
			$template = locate_template( array(
				"{$slug}-{$name}.php",
				"recipes/{$slug}-{$name}.php",
			) );
		}

		// Get default slug-name.php
		if ( ! $template && $name && file_exists( $this->templates_path . "{$slug}-{$name}.php" ) ) {
			$template = $this->templates_path . "{$slug}-{$name}.php";
		}

		// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php
		if ( ! $template ) {
			$template = locate_template( array(
				"{$slug}.php",
				"recipes/{$slug}.php",
				$this->templates_path . "{$slug}.php"
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
	 * @access public
	 *
	 * @param mixed $template
	 * @return string
	 */
	public function template_loader( $template ) {
		$find = array( 'recipes.php' );
		$file = '';

		if ( is_single() && 'recipe' == get_post_type() ) {

			$file 	= 'single-recipe.php';
			$find[] = $file;
			$find[] = $this->templates_path . $file;

		} elseif ( is_post_type_archive( 'product' ) ) {

			$file 	= 'archive-recipe.php';
			$find[] = $file;
			$find[] = $this->templates_path . $file;

		}

		if ( $file ) {
			$template = locate_template( array_unique( $find ) );
			if ( ! $template ) {
				$template = $this->templates_path . $file;
			}
		}

		return $template;
	}
}
