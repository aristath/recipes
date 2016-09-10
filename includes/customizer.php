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

		// Add Panels.
		add_action( 'customize_register', array( $this, 'panels' ) );
		// Add Sections.
		add_action( 'customize_register', array( $this, 'sections' ) );
		// Add Settings.
		add_action( 'customize_register', array( $this, 'settings' ) );
		// Add Controls.
		add_action( 'customize_register', array( $this, 'controls' ) );
		// Enqueue Customizer Scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_enqueue_scripts' ) );

	}

	/**
	 * Create Panels
	 *
	 * @since 1.1.0
	 * @access public
	 */
	public function panels( $wp_customize ) {

		$wp_customize->add_panel( 'recipes', array(
			'title'       => esc_attr__( 'Recipes', 'recipes' ),
			'description' => esc_attr__( 'Edit the way your recipes appear', 'recipes' ),
			'priority'    => 160,
		) );

	}

	/**
	 * Create Sections
	 *
	 * @since 1.1.0
	 * @access public
	 */
	public function sections( $wp_customize ) {

		$wp_customize->add_section( 'recipes', array(
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
	 * @access public
	 */
	public function settings( $wp_customize ) {

		$wp_customize->add_setting( 'recipes_show_featured_image', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );

		$wp_customize->add_setting( 'recipes_intro_style', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'default'           => 'blockquote',
			'transport'         => 'refresh',
			'sanitize_callback' => array( $this, 'sanitize_intro_style' ),
		) );

	}

	/**
	 * Create Controls
	 *
	 * @since 1.1.0
	 * @access public
	 */
	public function controls( $wp_customize ) {

		$wp_customize->add_control( 'recipes_show_featured_image', array(
			'type'        => 'checkbox',
			'section'     => 'recipes',
			'label'       => esc_attr__( 'Show Featured Image', 'recipes' ),
			'description' => esc_attr__( 'Check to show featured images, uncheck to hide them.', 'recipes' ),
		) );

		$wp_customize->add_control( 'recipes_intro_style', array(
			'type'        => 'radio',
			'section'     => 'recipes',
			'label'       => esc_attr__( 'Recipe "intro" style', 'recipes' ),
			'choices'     => array(
				'blockquote' => esc_attr__( 'Blockquote', 'recipes' ),
				'custom'     => esc_attr__( 'Custom', 'recipes' ),
			),
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
