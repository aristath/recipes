<?php

/**
 * Create the customizer panels and sections
 */
function maera_recipes_customizer_panels_sections( $wp_customize ) {

    /**
     * Add sections
     */

    $wp_customize->add_section( 'recipes', array(
        'title'           => __( 'Recipes', 'maera-recipes' ),
        'priority'        => 10,
        'active_callback' => 'maera_recipes_is_singular_recipe'
    ) );

}
add_action( 'customize_register', 'maera_recipes_customizer_panels_sections' );

/**
 * Create the fields.
 */
function maera_recipes_customizer_fields( $wp_customize ) {

    // Display Ingredients
    $wp_customize->add_setting( 'maera_recipes[display_ingredients]', array(
        'default'        => '1',
        'type'           => 'option',
        'capability'     => 'manage_options',
    ) );

    $fields = array(
        array(
            'setting'     => 'display_ingredients',
            'label'       => __( 'Display ingredients in the content.', 'maera-recipes' ),
            'description' => __( 'This is by default on, but if you use the "Recipe Ingredients" widget you may want to disable this option.', 'maera-recipes' ),
            'section'     => 'recipes',
            'type'        => 'checkbox',
            'priority'    => 10,
            'default'     => '1',
        ),
        array(
            'label'           => __( 'Show the units converter', 'maera-recipes' ),
            'section'         => 'recipes',
            'setting'         => 'display_units_converter',
            'type'            => 'checkbox',
            'priority'        => 20,
            'active_callback' => 'maera_recipes_display_ingredients',
            'default'         => '1'
        ),
        array(
            'label'           => __( 'Display Featured Images', 'maera-recipes' ),
            'section'         => 'recipes',
            'setting'         => 'display_featured_image',
            'type'            => 'checkbox',
            'priority'        => 20,
            'default'         => '1'
        ),
        array(
            'label'           => __( 'Display Recipe Description', 'maera-recipes' ),
            'section'         => 'recipes',
            'setting'         => 'display_description',
            'type'            => 'checkbox',
            'priority'        => 20,
            'default'         => '1'
        ),
        array(
            'label'           => __( 'Display Rating', 'maera-recipes' ),
            'section'         => 'recipes',
            'setting'         => 'display_rating',
            'type'            => 'checkbox',
            'priority'        => 20,
            'default'         => '1'
        ),
        array(
            'label'           => __( 'Display Author', 'maera-recipes' ),
            'section'         => 'recipes',
            'setting'         => 'display_author',
            'type'            => 'checkbox',
            'priority'        => 20,
            'default'         => '1'
        ),
        array(
            'label'           => __( 'Display Author', 'maera-recipes' ),
            'section'         => 'recipes',
            'setting'         => 'display_date',
            'type'            => 'checkbox',
            'priority'        => 20,
            'default'         => '1'
        ),
        array(
            'label'           => __( 'Allow Front-End Editing', 'maera-recipes' ),
            'section'         => 'recipes',
            'setting'         => 'allow_frontend_editor',
            'type'            => 'checkbox',
            'priority'        => 20,
            'default'         => '1'
        )
    );

    foreach ( $fields as $field ) {
        // Create the setting
        $wp_customize->add_setting( 'maera_recipes[' . $field['setting'] . ']', array(
            'default'        => $field['default'],
            'type'           => 'option',
            'capability'     => 'manage_options',
        ) );

        $wp_customize->add_control( 'maera_recipes_' . $field['setting'], array(
            'label'           => $field['label'],
            'section'         => $field['section'],
            'settings'        => 'maera_recipes[' . $field['setting'] . ']',
            'type'            => $field['type'],
            'priority'        => $field['priority'],
        ) );

    }

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
