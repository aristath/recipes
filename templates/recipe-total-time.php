<div class="recipe-total-time">
    <?php if ( get_field( 'prep_time' ) && get_field( 'cook_time' ) ) : ?>
        <?php
            $total_time = intval( get_field( 'prep_time' ) ) + intval( get_field( 'cook_time' ) );
            $hours      = 0;
            $minutes    = $total_time;
            if ( 60 < $total_time ) {
                $hours   = intval( $total_time / 60 );
                $minutes = $total_time - ( $hours * 60 );
            }

            if ( 0 == $hours ) {
                $time = sprintf( __( '%d min', 'recipes' ), $minutes );
            } elseif ( 1 == $hours ) {
                $time = sprintf( __( '1 hour %d min', 'recipes' ), $minutes );
            } else {
                $time = sprintf( __( '%1$d hours %2$d min', 'recipes' ), $hours, $minutes );
            }

            $short_time = ( 0 == $hours ) ? 'PT' . $minutes . 'M' : 'PT' . $hours . 'H' . $minutes . 'M';
        ?>
        <?php _e( 'Total time:', 'recipes' ); ?>
        <time datetime="<?php echo $short_time; ?>" itemprop="totalTime"><?php echo $time; ?></time>
    <?php endif; ?>
</div>
