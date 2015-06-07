<?php if ( get_field( 'prep_time' ) ) : ?>
    <?php _e( 'Prep time:', 'maera-recipes' ); ?>
    <time datetime="PT<?php the_field( 'prep_time' ); ?>M" itemprop="prepTime"><?php printf( __( '%s min' ), get_field( 'prep_time' ) ); ?></time>
<?php endif;
