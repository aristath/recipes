<div class="recipe-rating">
    <?php

    global $post;
    $settings = get_option( 'maera_recipes' );
    ?>

    <?php
    if ( ! function_exists( 'wp_star_rating' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/template.php' );
    }
    wp_star_rating( array(
        'rating' => get_post_meta( $post->ID, 'comment_rating-average-rating', true ),
        'type'   => 'rating',
        'number' => Maera_Recipes_Reviews::count_votes( $post->ID ),
    ) );
    ?>

</div>
