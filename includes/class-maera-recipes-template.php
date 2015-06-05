<?php

class Maera_Recipes_Template {

    public function __construct() {

        add_filter( 'the_content', array( $this, 'single_recipe_content' ) );

    }

    function single_recipe_content( $content ) {
        global $post;

        // Are we on a recipe?
        // Does the user have a template file for content-recipe in their theme?
        if ( ( 'recipe' != $post->post_type ) || '' != locate_template( 'content-recipe.php' ) ) {
            return $content;
        }

        load_template( MAERA_RECIPES_PATH . 'templates/content-recipe.php' );

    }

}
