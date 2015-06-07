<?php if ( get_field( 'cook_time' ) ) : ?>
    <?php _e( 'Cook time:', 'maera-recipes' ); ?>
    <time datetime="PT<?php the_field( 'cook_time' ); ?>M" itemprop="cookTime"><?php printf( __( '%s min' ), get_field( 'cook_time' ) ); ?></time>
<?php endif;
