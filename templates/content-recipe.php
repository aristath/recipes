<?php

global $post;
$settings = get_option( 'maera_recipes' );
?>

<div class="recipe-wrapper" itemscope itemtype="http://schema.org/Recipe">
    <?php
    /**
     * The image if one exists.
     */
    ?>
    <?php if ( has_post_thumbnail() ) : ?>
        <img itemprop="image" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" />
    <?php endif; ?>

    <?php
    /**
     * The recipe meta (author, date etc)
     */
    ?>
    <div class="recipe-meta">

        <?php
        /**
         * The author
         */
        ?>
        <div class="author">
            <?php _e( 'By', 'maera-recipes' ); ?> <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author(); ?></span></span>
        </div>
        <?php
        /**
         * The date
         */
        ?>
        <div class="recipe-post-time">
            <?php _e( 'Published:', 'maera-recipes' ); ?> <time datetime="<?php the_time( 'Y-m-d' ); ?>" itemprop="datePublished"><?php the_time(); ?></time>
        </div>
    </div>
    <?php
    /**
     * A short description for this recipe.
     */
    ?>
    <?php if ( has_excerpt() ) : ?>
        <span itemprop="description"><?php the_excerpt(); ?></span>
    <?php endif; ?>
    <?php
    /**
     * Rating
     */
    ?>
    <?php
    if ( ! function_exists( 'wp_star_rating' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/template.php' );
    }
    wp_star_rating( array(
        'rating' => get_post_meta( $post->ID, 'comment_rating-average-rating', true ),
        'type'   => 'rating',
        'number' => Maera_Recipes_Reviews::$count_votes,
    ) );
    ?>

    <?php
    /**
     * The details of this recipe.
     */
    ?>
    <div class="recipe-details">

        <?php
        /**
         * Preparation time
         */
        ?>
        <?php if ( get_field( 'preparation_time' ) ) : ?>
            <?php _e( 'Prep time:', 'maera-recipes' ); ?>
            <time datetime="PT<?php the_field( 'preparation_time' ); ?>M" itemprop="prepTime"><?php printf( __( '%s min' ), get_field( 'preparation_time' ) ); ?></time>
        <?php endif; ?>

        <?php
        /**
         * Cooking time
         */
        ?>
        <?php if ( get_field( 'cook_time' ) ) : ?>
            <?php _e( 'Cook time:', 'maera-recipes' ); ?>
            <time datetime="PT<?php the_field( 'cook_time' ); ?>M" itemprop="cookTime"><?php printf( __( '%s min' ), get_field( 'cook_time' ) ); ?></time>
        <?php endif; ?>

        <?php
        /**
         * Total time
         */
        ?>
        <?php if ( get_field( 'preparation_time' ) && get_field( 'cook_time' ) ) : ?>
            <?php
                $total_time = intval( get_field( 'preparation_time' ) ) + intval( get_field( 'cook_time' ) );
                $hours      = 0;
                $minutes    = $total_time;
                if ( 60 < $total_time ) {
                    $hours   = intval( $total_time / 60 );
                    $minutes = $total_time - ( $hours * 60 );
                }

                if ( 0 == $hours ) {
                    $time = sprintf( __( '%d min', 'maera-recipes' ), $minutes );
                } elseif ( 1 == $hours ) {
                    $time = sprintf( __( '1 hour %d min', 'maera-recipes' ), $minutes );
                } else {
                    $time = sprintf( __( '%1$d hours %2$d min', 'maera-recipes' ), $hours, $minutes );
                }

                $short_time = ( 0 == $hours ) ? 'PT' . $minutes . 'M' : 'PT' . $hours . 'H' . $minutes . 'M';
            ?>
            <?php _e( 'Total time:', 'maera-recipes' ); ?>
            <time datetime="<?php echo $short_time; ?>" itemprop="totalTime"><?php echo $time; ?></time>
        <?php endif; ?>

        <?php
        /**
         * Servings
         */
        ?>
        <span itemprop="recipeYield"><?php printf( _n( '%d serving', '%d servings', get_field( 'servings' ), 'maera-recipes' ), get_field( 'servings' ) ); ?></span>

        <?php
        /**
         * Ingredients
         */
        ?>
        <div class="ingredients-wrapper">

            <?php if ( isset( $settings['display_units_converter'] ) && $settings['display_units_converter'] ) : ?>
                <div class="units-switch <?php echo ( isset( $_GET['mode'] ) ) ? $_GET['mode'] : ''; ?>">
                    <a href="?mode=metric" class="metric"><?php _e( 'Metric', 'maera-recipes' ); ?></a>
                    <a href="?mode=imperial" class="imperial"><?php _e( 'Imp.', 'maera-recipes' ); ?></a>
                    <a href="?mode=us" class="us"><?php _e( 'US', 'maera-recipes' ); ?></a>
                </div>
            <?php endif; ?>

            <?php if ( have_rows( 'ingredients' ) ) : ?>
                <ul>
                    <?php while ( have_rows( 'ingredients' ) ) : the_row(); ?>
                        <?php
                            $unit        = Maera_Recipes::units( Maera_Recipes::convert_units( get_sub_field( 'quantity' ), get_sub_field( 'unit' ), 'unit' ) );
                            $ingredient = get_sub_field( 'ingredient' );
                            $value      = Maera_Recipes::convert_units( get_sub_field( 'quantity' ), get_sub_field( 'unit' ), 'value' );
                        ?>
                        <li>
                            <a class="ingredient" href="<?php echo get_term_link( $ingredient ); ?>"><span itemprop="ingredients"><?php echo $ingredient->name; ?></span></a>:
                            <span class="quantity"><?php echo $value; ?><span class="unit"><?php echo $unit; ?></span></span>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

        </div>

        <?php
        /**
         * Directions
         */
        ?>
        <div class="directions">
            <?php _e( 'Directions:', 'maera-recipes' ); ?>
            <div itemprop="recipeInstructions">
                <?php the_field( 'recipe' ); ?>
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <?php
    /**
     * Edit button
     */
    ?>
    <?php if ( current_user_can( 'edit_post', $post->ID ) ) : ?>
        <button class="show-recipe-edit-form"><?php _e( 'Edit recipe', 'maera-recipes' ); ?></button>
    <?php endif; ?>
    <?php
    /**
     * Edit form
     */
    ?>
    <?php if ( current_user_can( 'edit_post', $post->ID ) ) : ?>
        <div class="recipe-edit-form" style="display: none;">
            <?php acf_form(); ?>
        </div>
    <?php endif; ?>

</div>
<?php
/**
 * Show/hide the form when we click the edit button.
 */
?>
<script>
    (function($) { $(function() {
        $( ".show-recipe-edit-form" ).click( function() {
            $( ".recipe-edit-form" ).toggle();
        });
    }); })(jQuery);
</script>
