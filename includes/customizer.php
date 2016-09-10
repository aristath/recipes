<?php
/**
 * The Recipes customizer implementation.
 *
 * @package Recipes
 */

/**
 * The recipes customizer class.
 *
 * @since 1.1.0
 */
class Recipes_Customizer {

	/**
	 * The Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// Add the Kirki installer control.
		add_action( 'init', array( $this, 'recommend_kirki' ) );

		// Do not proceed any further if Kirki is not installed.
		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}
		// Add config.
		$this->config();
		// Add Panels.
		$this->panels();
		// Add Sections.
		$this->sections();
		// Add Fields.
		$this->fields();

		// Enqueue Customizer Scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_enqueue_scripts' ) );

	}

	/**
	 * Recommend the installation of the Kirki plugin.
	 *
	 * @access public
	 * @since 1.1.0
	 */
	public function recommend_kirki() {
		include_once wp_normalize_path( Recipes::$plugin_path . '/includes/recommend-kirki.php' );
	}

	/**
	 * Add Kirki Config.
	 *
	 * @since 1.1.0
	 * @access private
	 */
	private function config() {
		Kirki::add_config( 'recipes', array(
			'option_type' => 'theme_mod',
			'capability'  => 'edit_theme_options',
		) );
	}

	/**
	 * Create Panels
	 *
	 * @since 1.1.0
	 * @access private
	 */
	private function panels() {

		Kirki::add_panel( 'recipes', array(
			'title'       => esc_attr__( 'Recipes', 'recipes' ),
			'description' => esc_attr__( 'Edit the way your recipes appear', 'recipes' ),
			'priority'    => 160,
		) );

	}

	/**
	 * Create Sections
	 *
	 * @since 1.1.0
	 * @access private
	 */
	private function sections() {

		Kirki::add_section( 'recipes', array(
			'title'       => esc_attr__( 'Recipes', 'recipes' ),
			'description' => esc_attr__( 'Edit the recipes options.', 'recipes' ),
			// 'panel'       => 'recipes',
			'priority'    => 1,
			'capability'  => 'edit_theme_options',
		) );

	}

	/**
	 * Create Settings
	 *
	 * @since 1.1.0
	 * @access private
	 */
	private function fields() {

		Kirki::add_field( 'recipes', array(
			'settings'          => 'recipes_show_featured_image',
			'type'              => 'checkbox',
			'section'           => 'recipes',
			'label'             => esc_attr__( 'Show Featured Image', 'recipes' ),
			'description'       => esc_attr__( 'Check to show featured images, uncheck to hide them.', 'recipes' ),
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );

		Kirki::add_field( 'recipes', array(
			'settings'          => 'recipes_intro_style',
			'type'              => 'radio',
			'section'           => 'recipes',
			'label'             => esc_attr__( 'Recipe Intro style', 'recipes' ),
			'default'           => 'blockquote',
			'transport'         => 'refresh',
			'sanitize_callback' => array( $this, 'sanitize_intro_style' ),
			'choices'           => array(
				'blockquote' => esc_attr__( 'Blockquote', 'recipes' ),
				'custom'     => esc_attr__( 'Custom', 'recipes' ),
			),
		) );

		Kirki::add_field( 'recipes', array(
			'type'        => 'sortable',
			'settings'    => 'recipe_elements_order_header',
			'label'       => esc_attr__( 'Recipe Elements Order And Visibility (Header).', 'recipes' ),
			'description' => esc_attr__( 'Select which elements to display in the header area for recipes, and their order.', 'recipes' ),
			'section'     => 'recipes',
			'choices'     => array(
				'title'          => esc_attr__( 'Title', 'recipes' ),
				'featured-image' => esc_attr__( 'Featured Image', 'recipes' ),
				'intro'          => esc_attr__( 'Intro', 'recipes' ),
				'general-info'   => esc_attr__( 'General Info', 'recipes' ),
			),
			'default'     => array(
				'title',
				'featured-image',
				'intro',
				'general-info',
			),
			'priority'    => 10,
		) );

		Kirki::add_field( 'recipes', array(
			'type'        => 'sortable',
			'settings'    => 'recipe_elements_order_content',
			'label'       => esc_attr__( 'Recipe Elements Order And Visibility (Content).', 'recipes' ),
			'description' => esc_attr__( 'Select which elements to display in the main content area for recipes, and their order.', 'recipes' ),
			'section'     => 'recipes',
			'choices'     => array(
				'content'        => esc_attr__( 'Content', 'recipes' ),
				'execution'      => esc_attr__( 'Execution', 'recipes' ),
			),
			'default'     => array(
				'content',
				'execution',
			),
			'priority'    => 10,
		) );

	}

	/**
	 * Sanitizes the value of a checkbox.
	 *
	 * @access public
	 * @param int|bool|string $value The value to sanitize.
	 * @return bool
	 */
	public function sanitize_checkbox( $value ) {

		if ( $value ) {
			return true;
		}
		return false;

	}

	/**
	 * Sanitizes the recipes_intro_style control values.
	 *
	 * @access public
	 * @param string $value The value to sanitize.
	 * @return string
	 */
	public function sanitize_intro_style( $value ) {

		$valid_values = array(
			'blockquote',
			'custom',
		);
		if ( ! in_array( $value, $valid_values ) ) {
			return 'blockquote';
		}
		return $value;

	}

	/**
	 * Enqueues scripts for the customizer.
	 *
	 * @access public
	 * @since 1.1.0
	 */
	public function customize_controls_enqueue_scripts() {
		wp_enqueue_script( 'recipes-customize', trailingslashit( Recipes::$plugin_url ) . 'assets/js/customize.js', array( 'jquery', 'customize-controls' ), false, true );
	}
}
