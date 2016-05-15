<?php

// Register Custom Post Type
function recipes_recipe_post_type() {

    $labels = array(
        'name'                => _x( 'Recipes', 'Post Type General Name', 'recipes' ),
        'singular_name'       => _x( 'Recipe', 'Post Type Singular Name', 'recipes' ),
        'menu_name'           => __( 'Recipes', 'recipes' ),
        'name_admin_bar'      => __( 'Recipe', 'recipes' ),
        'parent_item_colon'   => __( 'Parent Item:', 'recipes' ),
        'all_items'           => __( 'All Recipes', 'recipes' ),
        'add_new_item'        => __( 'Add New Recipe', 'recipes' ),
        'add_new'             => __( 'Add New', 'recipes' ),
        'new_item'            => __( 'New Item', 'recipes' ),
        'edit_item'           => __( 'Edit Item', 'recipes' ),
        'update_item'         => __( 'Update Item', 'recipes' ),
        'view_item'           => __( 'View Item', 'recipes' ),
        'search_items'        => __( 'Search Item', 'recipes' ),
        'not_found'           => __( 'Not found', 'recipes' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'recipes' ),
    );
    $args = array(
        'label'               => __( 'recipe', 'recipes' ),
        'description'         => __( 'Recipe', 'recipes' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'comments' ),
        'taxonomies'          => array( 'ingredients', ' recipe-category' ),
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
        'rewrite'             => array(
            'slug' =>'recipes',
        )
    );
    register_post_type( 'recipe', $args );

}

// Hook into the 'init' action
add_action( 'init', 'recipes_recipe_post_type', 0 );
