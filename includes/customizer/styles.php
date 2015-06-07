<?php

function maera_recipes_inline_styles() {

    $options = get_option( 'maera_recipes' );

    $options['display_ingredients']     = ! isset( $options['display_ingredients'] )     ? 1  : $options['display_ingredients'];
    $options['display_units_converter'] = ! isset( $options['display_units_converter'] ) ? 1  : $options['display_units_converter'];
    $options['ingredients_width']       = ! isset( $options['ingredients_width'] )       ? 25 : $options['ingredients_width'];

    $css = '';

    if ( $options['display_ingredients'] ) {

        if ( $options['display_units_converter'] ) {

        }

        if ( $options['display_units_converter'] ) {
            $css .= '.ingredients-wrapper{width:' . intval( $options['ingredients_width'] ) . '%;}';
        }

    }

    if ( '' != $css ) {
        echo '<style>' . $css . '</style>';
    }

}
add_action( 'wp_head', 'maera_recipes_inline_styles' );
