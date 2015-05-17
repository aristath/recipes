<?php

/**
 * The customizer configuration
 * Requires Kirki
 */
function maera_recipes_customizer_config( $config ) {
    $config['options_type'] = 'option';
    $config['option_name']  = 'maera_recipes';

    return $config;
}
add_filter( 'kirki/config', 'maera_recipes_customizer_config' );

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
 * Requires Kirki.
 */
function maera_recipes_customizer_fields( $fields ) {

    $fields[] = array(
        'type'        => 'slider',
        'settings'    => 'ingredients_width',
        'label'       => __( 'Percent width of the ingredients', 'maera-recipes' ),
        'section'     => 'ingredients',
        'default'     => 26,
        'priority'    => 10,
        'choices'     => array(
            'min'  => 0,
            'max'  => 40,
            'step' => 1
        ),
        'output' => array(
            array(
                'element'  => 'body .recipe-wrapper .recipe-flex-wrapper .ingredients-wrapper',
                'property' => 'min-width',
                'units'    => '%',
            )
        ),
    );

    $fields[] = array(
        'type'            => 'switch',
        'settings'        => 'display_units_converter',
        'label'           => __( 'Show the units converter', 'maera-recipes' ),
        'section'         => 'ingredients',
        'default'         => 1,
        'priority'        => 20,
    );

    $fields[] = array(
        'type'     => 'select',
        'settings' => 'ingredients_font_family',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'section'  => 'ingredients',
        'default'  => 1,
        'priority' => 20,
        'output'   => array(
            'element'  => '.recipe-wrapper .recipe-flex-wrapper .ingredients-wrapper',
            'property' => 'font-family',
        )
    );

    return $fields;

 }
 add_filter( 'kirki/fields', 'maera_recipes_customizer_fields' );

 /**
  * Check if we're on a single recipe or not.
  */
function maera_recipes_is_singular_recipe() {
    return is_singular( 'recipe' );
}
