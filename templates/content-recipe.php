<div class="recipe-wrapper" itemscope itemtype="http://schema.org/Recipe">

    <div class="recipe-header">
        <?php if ( recipes_get_option( 'display_featured_image' ) ) : ?>
            <?php recipes_get_template_part( 'recipe-featured-image' ); ?>
        <?php endif; ?>
        <?php if ( recipes_get_option( 'display_description' ) ) : ?>
            <?php recipes_get_template_part( 'recipe-description' ); ?>
        <?php endif; ?>
        <?php if ( recipes_get_option( 'display_rating' ) ) : ?>
            <?php recipes_get_template_part( 'recipe-rating' ); ?>
        <?php endif; ?>
    </div>

    <div class="clearfix"></div>

    <div class="recipe-details">

        <div class="recipe-meta">
            <?php if ( recipes_get_option( 'display_author' ) ) : ?>
                <?php recipes_get_template_part( 'recipe-author' ); ?>
            <?php endif; ?>
            <?php if ( recipes_get_option( 'display_date' ) ) : ?>
                <?php recipes_get_template_part( 'recipe-date' ); ?>
            <?php endif; ?>
        </div>

        <div class="recipe-info">
            <?php recipes_get_template_part( 'recipe-prep-time' ); ?>
            <?php recipes_get_template_part( 'recipe-cook-time' ); ?>
            <?php recipes_get_template_part( 'recipe-total-time' ); ?>
            <?php recipes_get_template_part( 'recipe-servings' ); ?>
            <?php if ( recipes_get_option( 'display_ingredients' ) ) : ?>
                <h4><?php _e( 'Ingredients', 'recipes' ); ?></h4>
                <?php if ( recipes_get_option( 'display_units_converter' ) ) : ?>
                    <?php recipes_get_template_part( 'recipe-units-switch' ); ?>
                <?php endif; ?>
                <?php recipes_get_template_part( 'recipe-ingredients' ); ?>
            <?php endif; ?>
        </div>

    </div>

    <div class="recipe-content">
        <?php recipes_get_template_part( 'recipe-directions' ); ?>
        <?php if ( recipes_get_option( 'allow_frontend_editor' ) ) : ?>
            <?php recipes_get_template_part( 'recipe-edit' ); ?>
        <?php endif; ?>
    </div>

</div>
