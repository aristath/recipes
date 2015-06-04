<?php

class Maera_Recipes_Admin_Styles extends Maera_Recipes {

    public function __construct() {
        if ( $this->is_recipe() && $this->is_edit() ) {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        }
    }

    public function enqueue_styles() {
        wp_enqueue_style( 'maera-recipes-admin', MAERA_RECIPES_URL . '/assets/css/admin-post-edit.css' );
    }

}
