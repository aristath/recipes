<?php

class Maera_Recipes {

    public $is_edit        = null;
    public $is_recipe      = false;
    public $is_edit_recipe = false;

    public $template;

    public function __construct() {
        $this->is_edit        = $this->is_edit();
        $this->is_recipe      = $this->is_recipe();
        $this->is_edit_recipe = ( $this->is_edit && $this->is_recipe );
    }

    /**
     * function to check if the current page is a post edit page
     *
     * @param  string  $new_edit what page to check for accepts new - new post page ,edit - edit post page, null for either
     * @return boolean
     */
    public function is_edit( $new_edit = null ) {

        global $pagenow;

        //make sure we are on the backend
        if ( ! is_admin() ) {
            return false;
        }

        if ( 'edit' == $new_edit ) {
            return in_array( $pagenow, array( 'post.php',  ) );
        }
        //check for new post page
        elseif ( 'new' == $new_edit ) {
            return in_array( $pagenow, array( 'post-new.php' ) );
        }
        //check for either new or edit
        else {
            return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
        }

    }

    /**
     * Do we have post_type=recipe in the URL?
     * @return boolean
     */
    public function is_recipe() {
        return ( isset( $_GET['post_type'] ) && 'recipe' == $_GET['post_type'] ) ? true : false;
     }

}
