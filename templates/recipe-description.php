<?php if ( get_field( 'description' ) ) : ?>
    <div class="recipe-description">
        <span itemprop="description"><?php the_field( 'description' ); ?></span>
    </div>
<?php endif;
