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

        $template  = '';
        $template .= $this->the_info();
        $template .= '<div style="display: flex;">';
        $template .= '<div class="ingredients-wrapper" style="border-right: 1px solid #dedede; padding: 0 1em; min-width: 175px; font-size: .85em;">' . $this->the_ingredients() . '</div>';
        $template .= '<div class="execution" style="padding: 0 1em;">' . $content . '</div>';
        $template .= '</div>';

        return $template;

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

                $ingredients .= '<li>';
                $ingredients .= '<span class="quantity">' . $quantity . '<span class="unit">' . $unit . '</span></span>';
                $ingredients .= '<a href="' . get_term_link( $ingredient ) . '">' . $ingredient->name . '</a>';
                $ingredients .= '</li>';

            }

            $ingredients .= '</ul>';

        }

        return apply_filters( 'maera_recipes/template/ingredients', $ingredients );

    }

    public function the_info() {

        $servings  = get_field( 'servings' );
        $calories  = get_field( 'calories' );
        $prep_time = get_field( 'preparation_time' );

        $template  = '<div class="recipe-info">';
        $template .= '<div class="servings">' . __( 'Servings:', 'maera-recipes' ) . '<span class="value">' . $servings . '</span></div>';
        $template .= '<div class="calories">' . __( 'Calories:', 'maera-recipes' ) . '<span class="value">' . $calories . '</span>' . __( 'Kcal', 'maera-recipes' ) . '</div>';
        $template .= '<div class="prep_time">' . __( 'Preparation Time:', 'maera-recipes' ) . '<span class="value">' . $prep_time . '</span>' . __( 'minutes', 'maera-recipes' ) . '</div>';
        $template .= '</div>';

        return apply_filters( 'maera_recipes/template/info', $template );

    }

}
