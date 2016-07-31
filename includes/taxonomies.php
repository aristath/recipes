<?php

/**
 * Registers the Custom Taxonomy.
 *
 * @since 1.0.0
 */
function recipes_recipe_category_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Categories', 'Taxonomy General Name', 'recipes' ),
        'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'recipes' ),
        'menu_name'                  => __( 'Recipe Category', 'recipes' ),
        'all_items'                  => __( 'All Categories', 'recipes' ),
        'parent_item'                => __( 'Parent Category', 'recipes' ),
        'parent_item_colon'          => __( 'Parent Category:', 'recipes' ),
        'new_item_name'              => __( 'New Recipe Category', 'recipes' ),
        'add_new_item'               => __( 'Add New Category', 'recipes' ),
        'edit_item'                  => __( 'Edit Category', 'recipes' ),
        'update_item'                => __( 'Update Category', 'recipes' ),
        'view_item'                  => __( 'View Category', 'recipes' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'recipes' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'recipes' ),
        'choose_from_most_used'      => __( 'Choose from the most used recipe categories', 'recipes' ),
        'popular_items'              => __( 'Popular Categories', 'recipes' ),
        'search_items'               => __( 'Search Recipe Categories', 'recipes' ),
        'not_found'                  => __( 'Not Found', 'recipes' ),
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
add_action( 'init', 'recipes_recipe_category_taxonomy', 0 );
