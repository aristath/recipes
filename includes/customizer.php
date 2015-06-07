<?php

/**
 * Create the customizer panels and sections
 */
function maera_recipes_customizer_panels_sections( $wp_customize ) {

    /**
     * Add panels
     */
    $wp_customize->add_panel( 'recipes', array(
        'priority'    => 10,
        'title'       => __( 'Recipes', 'maera-recipes' ),
        'description' => __( 'Recipes Options', 'maera-recipes' ),
    ) );

    /**
     * Add sections
     */

    // This section will be inside the "typography" panel
    $wp_customize->add_section( 'ingredients', array(
        'title'           => __( 'Ingredients', 'maera-recipes' ),
        'priority'        => 10,
        'panel'           => 'recipes',
        'active_callback' => 'maera_recipes_is_singular_recipe'
    ) );

}
add_action( 'customize_register', 'maera_recipes_customizer_panels_sections' );

/**
 * Create the fields.
 */
function maera_recipes_customizer_fields( $wp_customize ) {

    if ( ! class_exists( 'Kirki_Controls_Slider_Control' ) ) {
        include_once( MAERA_RECIPES_PATH . 'includes/customizer/controls/slider/class-kirki-controls-slider-control.php' );
    }

    // Display Ingredients
    $wp_customize->add_setting( 'maera_recipes[display_ingredients]', array(
        'default'        => '1',
        'type'           => 'option',
        'capability'     => 'manage_options',
    ) );

    $wp_customize->add_control( 'maera_recipes_display_ingredients', array(
        'label'       => __( 'Display ingredients in the content.', 'maera-recipes' ),
        'description' => __( 'This is by default on, but if you use the "Recipe Ingredients" widget you may want to disable this option.', 'maera-recipes' ),
        'section'     => 'ingredients',
        'settings'    => 'maera_recipes[display_ingredients]',
        'type'        => 'checkbox',
        'priority'    => 10
    ) );

    // Display Units converter
    $wp_customize->add_setting( 'maera_recipes[display_units_converter]', array(
        'default'        => '1',
        'type'           => 'option',
        'capability'     => 'manage_options',
    ) );

    $wp_customize->add_control( 'maera_recipes_display_units_converter', array(
        'label'       => __( 'Show the units converter', 'maera-recipes' ),
        'section'     => 'ingredients',
        'settings'    => 'maera_recipes[display_units_converter]',
        'type'        => 'checkbox',
        'priority'    => 20
    ) );

    // Ingredients width
    $wp_customize->add_setting( 'maera_recipes[ingredients_width]', array(
        'default'        => 25,
        'type'           => 'option',
        'capability'     => 'manage_options',
    ) );

    $wp_customize->add_control( new Kirki_Controls_Slider_Control( $wp_customize, 'maera_recipes_ingredients_width', array(
        'settings' => 'maera_recipes[ingredients_width]',
        'label'    => __( 'Percent width of the ingredients', 'maera-recipes' ),
        'section'  => 'ingredients',
        'priority' => 30,
        'choices'  => array(
            'min'  => 20,
            'max'  => 50,
            'step' => 1
        ),
        'active_callback' => 'maera_recipes_display_ingredients',
    ) ) );

 }
 add_action( 'customize_register', 'maera_recipes_customizer_fields' );

 /**
  * Check if we're on a single recipe or not.
  */
function maera_recipes_is_singular_recipe() {
    return is_singular( 'recipe' );
}

function maera_recipes_display_ingredients( $control ) {
    if ( 1 == $control->manager->get_setting( 'maera_recipes[display_ingredients]')->value() ) {
        return true;
    } else {
        return false;
    }
}
