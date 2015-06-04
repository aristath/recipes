<?php

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
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions' ),
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
add_action( 'init', 'maera_recipes_recipe_post_type', 0 );
