<?php
/**
 * Plugin Name: Recipes
 * Plugin URI:  https://press.codes
 * Version:	    0.1.0
 * Text Domain: recipes
 */

class Recipes {

	/**
	 * The plugin path.
	 *
	 * @access protected
	 * @var string
	 */
	protected $plugin_path;

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
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugins_url( '', __FILE__ );

		// Include files
		$this->includes();

		// Instantiate the metaboxes.
		new Recipes_Metaboxes_General_Info();
		new Recipes_Metaboxes_Ingredients();

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	/**
	 * Include all other files.
	 *
	 * @access private
	 */
	private function includes() {
		require_once( $this->plugin_path . 'includes/post-type.php' );
		require_once( $this->plugin_path . 'includes/taxonomies.php' );
		require_once( $this->plugin_path . 'includes/class-recipes-metaboxes.php' );
		require_once( $this->plugin_path . 'includes/class-recipes-metaboxes-general-info.php' );
		require_once( $this->plugin_path . 'includes/class-recipes-metaboxes-ingredients.php' );
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
		wp_enqueue_script( 'jquery-repeater', trailingslashit( $this->plugin_url ) . 'assets/js/vendor/jquery.repeater.js', array( 'jquery' ) );
		wp_enqueue_script( 'recipes', trailingslashit( $this->plugin_url ) . 'assets/js/recipes-admin.js', array( 'jquery', 'jquery-repeater' ) );
		wp_enqueue_style( 'recipes-admin', $this->plugin_url . '/assets/css/admin-post-edit.css' );
	}
}
new Recipes();
