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
