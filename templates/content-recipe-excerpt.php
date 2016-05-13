<div class="recipe-excerpt">
    <div class="alignleft">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'thumbnail' ); ?>
        <?php endif; ?>
    </div>
    <div class="alignleft">
        <?php recipes_get_template_part( 'recipe-description' ); ?>
    </div>
</div>
