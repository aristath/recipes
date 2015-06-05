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

        if ( isset( $_GET['post_type'] ) && 'recipe' == $_GET['post_type'] ) {
            return true;
        } else {
            return false;
        }
     }

     public static function units( $unit = null ) {

         $units = array(
             'teaspoon'   => __( 'teaspoon', 'maera-recipes' ),
             'tablespoon' => __( 'tablespoon', 'maera-recipes' ),
             'cup'        => __( 'cup', 'maera-recipes' ),
             'us-gal'     => __( 'gallon (US)', 'maera-recipes' ),
             'us-quart'   => __( 'quart (US)', 'maera-recipes' ),
             'us-pint'    => __( 'pint (US)', 'maera-recipes' ),
             'us-oz'      => __( 'ounce (US)', 'maera-recipes' ),
             'imp-gal'    => __( 'gallon (Imperial/UK)', 'maera-recipes' ),
             'imp-quart'  => __( 'quart (Imperial/UK)', 'maera-recipes' ),
             'imp-pint'   => __( 'pint (Imperial/UK)', 'maera-recipes' ),
             'imp-oz'     => __( 'ounce (Imperial/UK)', 'maera-recipes' ),
             'ml'         => __( 'ml', 'maera-recipes' ),
             'lt'         => __( 'lt', 'maera-recipes' ),
             'pound'      => __( 'pound', 'maera-recipes' ),
             'ounce'      => __( 'ounce', 'maera-recipes' ),
             'gr'         => __( 'gram', 'maera-recipes' ),
             'kg'         => __( 'kg', 'maera-recipes' ),
             'mm'         => __( 'mm', 'maera-recipes' ),
             'cm'         => __( 'cm', 'maera-recipes' ),
             'm'          => __( 'm', 'maera-recipes' ),
             'inch'       => __( 'inch', 'maera-recipes' ),
         );

         if ( null !== $unit ) {
             if ( isset( $units[$unit] ) ) {
                 return $units[$unit];
             } else {
                 return $unit;
             }
         }

     }

     /**
      * @var string  numeric or fraction value
      * @var string  the unit we're using
      * @var string  what we want to output. can be value/unit
      */
     public static function convert_units( $value, $unit, $output ) {
         if ( is_singular( 'recipe' ) && isset( $_GET['mode'] ) ) {
             $mode = $_GET['mode'];

             /**
              * Do not proceed if this is not a valid mode.
              * Instead just return the default values.
              */
             if ( ! in_array( $mode, array( 'metric', 'imperial', 'us' ) ) ) {
                 return ( 'value' == $output ) ? $value : $unit;
             }

             // Metric mode
             if ( 'metric' == $mode ) {

                 switch ( $unit ) {
                     case 'us-gal' :
                         $value = round( $value * 3785.41 );
                         $unit  = 'ml';
                         break;
                     case 'us-quart' :
                         $value = round( $value * 946.353 );
                         $unit  = 'ml';
                         break;
                     case 'us-pint' :
                         $value = round( $value * 473.176 );
                         $unit  = 'ml';
                         break;
                     case 'us-floz' :
                         $value = round( $value * 29.5735 );
                         $unit  = 'ml';
                         break;
                     case 'imp-gal' :
                         $value = round( $value * 4546.09 );
                         $unit  = 'ml';
                         break;
                     case 'imp-quart' :
                         $value = round( $value * 1136.52 );
                         $unit  = 'ml';
                         break;
                     case 'imp-pint' :
                         $value = round( $value * 568.261 );
                         $unit  = 'ml';
                         break;
                     case 'imp-floz' :
                         $value = round( $value * 28.4131 );
                         $unit  = 'ml';
                         break;
                     case 'pound' :
                         $value = round( $value * 453.592 );
                         $unit  = 'gram';
                         break;
                     case 'ounce' :
                         $value = round( $value * 28.3495 );
                         $unit  = 'gram';
                         break;
                     case 'inch' :
                         $value = round( $value * 2.54, 1 );
                         $unit  = 'cm';
                         break;

                 }

                 // If the value is too large then round and change the unit
                 if ( 1000 < $value ) {
                     if ( in_array( $unit, array( 'ml', 'gram' ) ) ) {
                         $value = round( $value / 1000, 2 );
                     }
                     $unit = 'ml' == $unit ? 'lt' : $unit;
                     $unit = 'gram' == $unit ? 'kg' : $unit;
                 }

             // US mode
             } elseif ( 'us' == $mode ) {

                 switch ( $unit ) {

                     case 'imp-gal' :
                         $value = round( $value * 1.20095, 2 );
                         $unit  = 'us-gal';
                         break;
                     case 'imp-quart' :
                         $value = round( $value * 1.20095, 2 );
                         $unit  = 'us-quart';
                         break;
                     case 'imp-pint' :
                         $value = round( $value * 1.20095, 2 );
                         $unit = 'us-pint';
                         break;
                     case 'imp-oz' :
                         $value = round( $value * 0.96076, 2 );
                         $unit  = 'us-oz';
                         break;
                     case 'ml' :
                         $value = round( $value * 0.033814, 2 );
                         $unit  = 'us-oz';
                         break;
                     case 'lt' :
                         $value = round( $value * 1.05669, 2 );
                         $unit  = 'us-quart';
                         break;
                     case 'gram' :
                         $value = round( $value * 0.035274, 2 );
                         $unit  = 'ounce';
                         break;
                     case 'kg' :
                         $value = round( $value * 2.20462, 2 );
                         $unit  = 'pound';
                         break;
                     case 'cm' :
                         $value = round( $value / 2.54 , 2 );
                         $unit  = 'inch';
                         break;
                     case 'm' :
                         $value = round( $value * 100 / 2.54 , 2 );
                         $unit  = 'inch';
                         break;

                 }

             // Imperial mode
             } elseif ( 'imperial' == $mode ) {

                 switch ( $unit ) {

                     case 'us-gal' :
                         $value = round( $value * 0.832674, 2 );
                         $unit  = 'imp-gal';
                         break;
                     case 'us-quart' :
                         $value = round( $value * 0.832674, 2 );
                         $unit  = 'imp-quart';
                         break;
                     case 'us-pint' :
                         $value = round( $value * 0.832674, 2 );
                         $unit  = 'imp-pint';
                         break;
                     case 'us-oz' :
                         $value = round( $value * 1.04084, 2 );
                         $unit  = 'imp-oz';
                         break;
                     case 'ml' :
                         $value = round( $value * 0.0351951, 2 );
                         $unit  = 'imp-oz';
                     case 'lt' :
                         $value = round( $value * 1.75975, 2 );
                         $unit  = 'imp-pint';
                         break;
                     case 'gram' :
                         $value = round( $value * 0.035274, 2 );
                         $unit  = 'ounce';
                         break;
                     case 'kg' :
                         $value = round( $value * 2.20462, 2 );
                         $unit  = 'pound';
                         break;
                     case 'cm' :
                         $value = round( $value / 2.54 , 2 );
                         $unit  = 'inch';
                         break;
                     case 'm' :
                         $value = round( $value * 100 / 2.54 , 2 );
                         $unit  = 'inch';
                         break;

                 }

             }

         }

         return ( 'value' == $output ) ? $value : $unit;

     }

}
