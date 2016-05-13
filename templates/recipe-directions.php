<div class="recipe-directions">
    <?php _e( 'Directions:', 'recipes' ); ?>
    <div itemprop="recipeInstructions">
        <?php the_field( 'recipe' ); ?>
        <?php the_content(); ?>
    </div>
</div>
