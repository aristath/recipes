<?php
/**
 * Plugin Name:       Maera Recipes
 * Plugin URI:        https://press.codes
 * Version:           0.1.0
 * Text Domain:       maera-recepes
 * Domain Path:       /languages/
 */

 // Register Custom Post Type
 function maera_recipes_recipe_post_type() {

 	$labels = array(
 		'name'                => _x( 'Recipes', 'Post Type General Name', 'maera-recipes' ),
 		'singular_name'       => _x( 'Recipe', 'Post Type Singular Name', 'maera-recipes' ),
 		'menu_name'           => __( 'Recipes', 'maera-recipes' ),
 		'name_admin_bar'      => __( 'Recipe', 'maera-recipes' ),
 		'parent_item_colon'   => __( 'Parent Item:', 'maera-recipes' ),
 		'all_items'           => __( 'All Recipes', 'maera-recipes' ),
 		'add_new_item'        => __( 'Add New Recipe', 'maera-recipes' ),
 		'add_new'             => __( 'Add New', 'maera-recipes' ),
 		'new_item'            => __( 'New Item', 'maera-recipes' ),
 		'edit_item'           => __( 'Edit Item', 'maera-recipes' ),
 		'update_item'         => __( 'Update Item', 'maera-recipes' ),
 		'view_item'           => __( 'View Item', 'maera-recipes' ),
 		'search_items'        => __( 'Search Item', 'maera-recipes' ),
 		'not_found'           => __( 'Not found', 'maera-recipes' ),
 		'not_found_in_trash'  => __( 'Not found in Trash', 'maera-recipes' ),
 	);
 	$args = array(
 		'label'               => __( 'recipe', 'maera-recipes' ),
 		'description'         => __( 'Recipe', 'maera-recipes' ),
 		'labels'              => $labels,
 		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', ),
 		'taxonomies'          => array( 'ingredients', ' recipe category' ),
 		'hierarchical'        => false,
 		'public'              => true,
 		'show_ui'             => true,
 		'show_in_menu'        => true,
 		'menu_position'       => 5,
 		'menu_icon'           => 'dashicons-carrot',
 		'show_in_admin_bar'   => true,
 		'show_in_nav_menus'   => true,
 		'can_export'          => true,
 		'has_archive'         => true,
 		'exclude_from_search' => false,
 		'publicly_queryable'  => true,
 		'capability_type'     => 'post',
 	);
 	register_post_type( 'recipe', $args );

 }

 // Hook into the 'init' action
 add_action( 'init', 'maera_recipes_recipe_post_type', 0 );

 // Register Custom Taxonomy
 function maera_recipes_ingredients_taxonomy() {

 	$labels = array(
 		'name'                       => _x( 'Ingredients', 'Taxonomy General Name', 'maera-recipes' ),
 		'singular_name'              => _x( 'Ingredient', 'Taxonomy Singular Name', 'maera-recipes' ),
 		'menu_name'                  => __( 'Ingredients', 'maera-recipes' ),
 		'all_items'                  => __( 'All Ingredients', 'maera-recipes' ),
 		'parent_item'                => __( 'Parent Item', 'maera-recipes' ),
 		'parent_item_colon'          => __( 'Parent Item:', 'maera-recipes' ),
 		'new_item_name'              => __( 'New Item Name', 'maera-recipes' ),
 		'add_new_item'               => __( 'Add New Ingredient', 'maera-recipes' ),
 		'edit_item'                  => __( 'Edit Ingredient', 'maera-recipes' ),
 		'update_item'                => __( 'Update Ingredient', 'maera-recipes' ),
 		'view_item'                  => __( 'View Ingredient', 'maera-recipes' ),
 		'separate_items_with_commas' => __( 'Separate ingredients with commas', 'maera-recipes' ),
 		'add_or_remove_items'        => __( 'Add or remove ingredients', 'maera-recipes' ),
 		'choose_from_most_used'      => __( 'Choose from the most used ingredients', 'maera-recipes' ),
 		'popular_items'              => __( 'Popular Ingredients', 'maera-recipes' ),
 		'search_items'               => __( 'Search Ingredients', 'maera-recipes' ),
 		'not_found'                  => __( 'Not Found', 'maera-recipes' ),
 	);
 	$args = array(
 		'labels'                     => $labels,
 		'hierarchical'               => false,
 		'public'                     => true,
 		'show_ui'                    => true,
 		'show_admin_column'          => true,
 		'show_in_nav_menus'          => true,
 		'show_tagcloud'              => true,
 	);
 	register_taxonomy( 'ingredient', array( 'recipe' ), $args );

 }

 // Hook into the 'init' action
 add_action( 'init', 'maera_recipes_ingredients_taxonomy', 0 );

 // Register Custom Taxonomy
 function maera_recipes_recipe_category_taxonomy() {

 	$labels = array(
 		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'maera-recipes' ),
 		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'maera-recipes' ),
 		'menu_name'                  => __( 'Recipe Category', 'maera-recipes' ),
 		'all_items'                  => __( 'All Categories', 'maera-recipes' ),
 		'parent_item'                => __( 'Parent Category', 'maera-recipes' ),
 		'parent_item_colon'          => __( 'Parent Category:', 'maera-recipes' ),
 		'new_item_name'              => __( 'New Recipe Category', 'maera-recipes' ),
 		'add_new_item'               => __( 'Add New Category', 'maera-recipes' ),
 		'edit_item'                  => __( 'Edit Category', 'maera-recipes' ),
 		'update_item'                => __( 'Update Category', 'maera-recipes' ),
 		'view_item'                  => __( 'View Category', 'maera-recipes' ),
 		'separate_items_with_commas' => __( 'Separate categories with commas', 'maera-recipes' ),
 		'add_or_remove_items'        => __( 'Add or remove categories', 'maera-recipes' ),
 		'choose_from_most_used'      => __( 'Choose from the most used recipe categories', 'maera-recipes' ),
 		'popular_items'              => __( 'Popular Categories', 'maera-recipes' ),
 		'search_items'               => __( 'Search Recipe Categories', 'maera-recipes' ),
 		'not_found'                  => __( 'Not Found', 'maera-recipes' ),
 	);
 	$args = array(
 		'labels'                     => $labels,
 		'hierarchical'               => true,
 		'public'                     => true,
 		'show_ui'                    => true,
 		'show_admin_column'          => true,
 		'show_in_nav_menus'          => true,
 		'show_tagcloud'              => true,
 	);
 	register_taxonomy( 'recipe-category', array( 'recipe' ), $args );

 }

 // Hook into the 'init' action
 add_action( 'init', 'maera_recipes_recipe_category_taxonomy', 0 );

 if( function_exists('acf_add_local_field_group') ):

 acf_add_local_field_group(array (
 	'key' => 'group_55555a1530f8c',
 	'title' => 'Recipe details',
 	'fields' => array (
 		array (
 			'key' => 'field_55555a2369fe5',
 			'label' => 'Servings',
 			'name' => 'servings',
 			'type' => 'number',
 			'instructions' => 'How many servings? (default: 2)',
 			'required' => 1,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '33.33',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => 2,
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => 'servings',
 			'min' => 1,
 			'max' => '',
 			'step' => 1,
 			'readonly' => 0,
 			'disabled' => 0,
 		),
 		array (
 			'key' => 'field_55555a6769fe6',
 			'label' => 'Calories',
 			'name' => 'calories',
 			'type' => 'number',
 			'instructions' => 'Nutritional value',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '33.33',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => 'Kcal',
 			'min' => '',
 			'max' => '',
 			'step' => '',
 			'readonly' => 0,
 			'disabled' => 0,
 		),
 		array (
 			'key' => 'field_5555621a6cbbf',
 			'label' => 'Preparation time',
 			'name' => 'preparation_time',
 			'type' => 'number',
 			'instructions' => 'The total time required for this recipe',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '33.33',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => 30,
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => 'minutes',
 			'min' => '',
 			'max' => '',
 			'step' => 1,
 			'readonly' => 0,
 			'disabled' => 0,
 		),
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'recipe',
 			),
 		),
 	),
 	'menu_order' => 10,
 	'position' => 'acf_after_title',
 	'style' => 'seamless',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 ));

 acf_add_local_field_group(array (
 	'key' => 'group_55555319558f3',
 	'title' => 'Recipe Ingredients',
 	'fields' => array (
 		array (
 			'key' => 'field_555554369c304',
 			'label' => 'Ingredients',
 			'name' => 'ingredients',
 			'type' => 'repeater',
 			'instructions' => 'Add the ingredients the recipe requires along with their quantities',
 			'required' => 1,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => 100,
 				'class' => '',
 				'id' => '',
 			),
 			'min' => 1,
 			'max' => '',
 			'layout' => 'table',
 			'button_label' => 'Add Ingredient',
 			'sub_fields' => array (
 				array (
 					'key' => 'field_5557864d39b01',
 					'label' => 'whole or fraction',
 					'name' => 'whole_fraction',
 					'type' => 'select',
 					'instructions' => 'Is the quantity a whole or a fraction?
 Example: 1/2 cup is a fraction, 1 tablespoon is a while. This only refers to the number.',
 					'required' => 1,
 					'conditional_logic' => 0,
 					'wrapper' => array (
 						'width' => 25,
 						'class' => '',
 						'id' => '',
 					),
 					'choices' => array (
 						'whole' => 'Whole',
 						'fraction' => 'Fraction',
 					),
 					'default_value' => array (
 						'whole' => 'whole',
 					),
 					'allow_null' => 0,
 					'multiple' => 0,
 					'ui' => 1,
 					'ajax' => 0,
 					'placeholder' => '',
 					'disabled' => 0,
 					'readonly' => 0,
 				),
 				array (
 					'key' => 'field_555554689c305',
 					'label' => 'Quantity',
 					'name' => 'quantity_whole',
 					'type' => 'number',
 					'instructions' => 'Please enter the quantity of the ingredient',
 					'required' => 1,
 					'conditional_logic' => array (
 						array (
 							array (
 								'field' => 'field_5557864d39b01',
 								'operator' => '!=',
 								'value' => 'fraction',
 							),
 						),
 					),
 					'wrapper' => array (
 						'width' => 20,
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => 1,
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'min' => '',
 					'max' => '',
 					'step' => '',
 					'readonly' => 0,
 					'disabled' => 0,
 				),
 				array (
 					'key' => 'field_55578786df56d',
 					'label' => 'Quantity',
 					'name' => 'quantity_fraction',
 					'type' => 'select',
 					'instructions' => 'Please select the quantity of the ingredient',
 					'required' => 1,
 					'conditional_logic' => array (
 						array (
 							array (
 								'field' => 'field_5557864d39b01',
 								'operator' => '==',
 								'value' => 'fraction',
 							),
 						),
 					),
 					'wrapper' => array (
 						'width' => 20,
 						'class' => '',
 						'id' => '',
 					),
 					'choices' => array (
 						'1/2' => '1/2',
 						'1/3' => '1/3',
 						'2/3' => '2/3',
 						'1/4' => '1/4',
 						'3/4' => '3/4',
 						'1/5' => '1/5',
 						'2/5' => '2/5',
 						'3/5' => '3/5',
 						'4/5' => '4/5',
 					),
 					'default_value' => array (
 						'half' => 'half',
 					),
 					'allow_null' => 0,
 					'multiple' => 0,
 					'ui' => 1,
 					'ajax' => 0,
 					'placeholder' => '',
 					'disabled' => 0,
 					'readonly' => 0,
 				),
 				array (
 					'key' => 'field_5557897305b35',
 					'label' => 'Unit',
 					'name' => 'unit',
 					'type' => 'select',
 					'instructions' => 'Select the unit for this quantity',
 					'required' => 1,
 					'conditional_logic' => 0,
 					'wrapper' => array (
 						'width' => 10,
 						'class' => '',
 						'id' => '',
 					),
 					'choices' => array (
 						'teaspoon' => 'teaspoon',
 						'tablespoon' => 'tablespoon',
 						'fluid-ounce' => 'fluid-ounce',
 						'cup' => 'cup',
 						'pint' => 'pint',
 						'quart' => 'quart',
 						'gallon' => 'gallon',
 						'ml' => 'ml',
 						'lt' => 'lt',
 						'dl' => 'dl',
 						'' => '',
 						'pound' => 'pound',
 						'ounce' => 'ounce',
 						'gram' => 'gram',
 						'kg' => 'kg',
 						'mm' => 'mm',
 						'cm' => 'cm',
 						'm' => 'm',
 						'inch' => 'inch',
 					),
 					'default_value' => array (
 						'kg' => 'kg',
 					),
 					'allow_null' => 0,
 					'multiple' => 0,
 					'ui' => 0,
 					'ajax' => 0,
 					'placeholder' => '',
 					'disabled' => 0,
 					'readonly' => 0,
 				),
 				array (
 					'key' => 'field_555554af9c306',
 					'label' => 'Ingredient',
 					'name' => 'ingredient',
 					'type' => 'taxonomy',
 					'instructions' => 'Please enter the ingredient',
 					'required' => 1,
 					'conditional_logic' => 0,
 					'wrapper' => array (
 						'width' => 50,
 						'class' => '',
 						'id' => '',
 					),
 					'taxonomy' => 'ingredient',
 					'field_type' => 'select',
 					'allow_null' => 0,
 					'add_term' => 1,
 					'load_save_terms' => 1,
 					'return_format' => 'id',
 					'multiple' => 0,
 				),
 			),
 		),
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'recipe',
 			),
 		),
 	),
 	'menu_order' => 20,
 	'position' => 'acf_after_title',
 	'style' => 'seamless',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 ));

 acf_add_local_field_group(array (
 	'key' => 'group_55555ce88f23e',
 	'title' => 'Videos',
 	'fields' => array (
 		array (
 			'key' => 'field_55555ced24348',
 			'label' => 'Videos',
 			'name' => 'videos',
 			'type' => 'repeater',
 			'instructions' => 'Have videos? Awesome! Just add them below.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'min' => '',
 			'max' => '',
 			'layout' => 'row',
 			'button_label' => 'Add Video',
 			'sub_fields' => array (
 				array (
 					'key' => 'field_55555d2c24349',
 					'label' => 'Video',
 					'name' => 'video',
 					'type' => 'oembed',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array (
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'width' => '',
 					'height' => '',
 				),
 			),
 		),
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'recipe',
 			),
 		),
 	),
 	'menu_order' => 20,
 	'position' => 'normal',
 	'style' => 'seamless',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 ));

 acf_add_local_field_group(array (
 	'key' => 'group_55555558956b1',
 	'title' => 'Recipe Photos',
 	'fields' => array (
 		array (
 			'key' => 'field_5555555f69227',
 			'label' => 'Gallery',
 			'name' => 'gallery',
 			'type' => 'gallery',
 			'instructions' => 'Please add photos to accompany this recipe',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'min' => '',
 			'max' => '',
 			'preview_size' => 'thumbnail',
 			'library' => 'uploadedTo',
 			'min_width' => '',
 			'min_height' => '',
 			'min_size' => '',
 			'max_width' => '',
 			'max_height' => '',
 			'max_size' => '',
 			'mime_types' => '',
 		),
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'recipe',
 			),
 		),
 	),
 	'menu_order' => 40,
 	'position' => 'normal',
 	'style' => 'seamless',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 ));

 endif;

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
$single_recipe_template = new Maera_Recipes_Template();
