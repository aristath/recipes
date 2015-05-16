<?php

class Maera_Recipes_Template {

    public function __construct() {

        add_filter( 'the_content', array( $this, 'single_recipe_content' ) );

    }

    public function single_recipe_content( $content ) {

        // No need to proceed any further if this in not a recipe.
        if ( ! is_singular( 'recipe' ) ) {
            return $content;
        }

        return $this->the_ingredients() . $content;

    }

    public function the_ingredients() {

        if ( have_rows( 'ingredients' ) ) {

            $ingredients = '<ul>';
            while ( have_rows( 'ingredients' ) ) {

                the_row();
                $whole_fraction  = get_sub_field( 'whole_fraction' );
                $quantity        = ( 'whole' == $whole_fraction ) ? get_sub_field( 'quantity_whole' ) : get_sub_field( 'quantity_fraction' );
                $unit            = get_sub_field( 'unit' );
                $ingredient      = get_term_by( 'id', get_sub_field( 'ingredient' ), 'ingredient' );

                $ingredients .= '<li><strong>' . $quantity . '</strong> ' . $unit . ' ' . '<a href="' . get_term_link( $ingredient ) . '">' . $ingredient->name . '</a></li>';

            }

            $ingredients .= '</ul>';

        }

        return $ingredients;

    }

}
