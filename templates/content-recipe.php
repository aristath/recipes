<div class="recipe-wrapper" itemscope itemtype="http://schema.org/Recipe">

    <div class="recipe-header">
        <?php maera_recipes_get_template_part( 'recipe-featured-image' ); ?>
        <?php maera_recipes_get_template_part( 'recipe-description' ); ?>
        <?php maera_recipes_get_template_part( 'recipe-rating' ); ?>
    </div>

    <div class="clearfix"></div>

    <div class="recipe-details">

        <div class="recipe-meta">
            <?php maera_recipes_get_template_part( 'recipe-author' ); ?>
            <?php maera_recipes_get_template_part( 'recipe-date' ); ?>
        </div>

        <div class="recipe-info">
            <?php maera_recipes_get_template_part( 'recipe-prep-time' ); ?>
            <?php maera_recipes_get_template_part( 'recipe-cook-time' ); ?>
            <?php maera_recipes_get_template_part( 'recipe-total-time' ); ?>
            <?php maera_recipes_get_template_part( 'recipe-servings' ); ?>
            <?php maera_recipes_get_template_part( 'recipe-units-switch' ); ?>
            <?php maera_recipes_get_template_part( 'recipe-ingredients' ); ?>
        </div>

    </div>

    <div class="recipe-content">
        <?php maera_recipes_get_template_part( 'recipe-directions' ); ?>
        <?php maera_recipes_get_template_part( 'recipe-edit' ); ?>
    </div>

</div>
