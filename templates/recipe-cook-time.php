<?php if ( get_field( 'cook_time' ) ) : ?>
    <div class="recipe-cook-time">
        <?php _e( 'Cook time:', 'maera-recipes' ); ?>
        <time datetime="PT<?php the_field( 'cook_time' ); ?>M" itemprop="cookTime"><?php printf( __( '%s min' ), get_field( 'cook_time' ) ); ?></time>
    </div>
<?php endif;
