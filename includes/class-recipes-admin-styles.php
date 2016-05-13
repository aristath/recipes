<?php

class Recipes_Admin_Styles extends Recipes {

    public function __construct() {
        if ( $this->is_recipe() && $this->is_edit() ) {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        }
    }

    public function enqueue_styles() {
        wp_enqueue_style( 'recipes-admin', RECIPES_URL . '/assets/css/admin-post-edit.css' );
    }

}
