<?php

global $post;
$settings = get_option( 'maera_recipes' );
?>
<?php if ( isset( $settings['display_units_converter'] ) && $settings['display_units_converter'] ) : ?>
    <div class="units-switch <?php echo ( isset( $_GET['mode'] ) ) ? $_GET['mode'] : ''; ?>">
        <a href="?mode=metric" class="metric recipe-button"><?php _e( 'Metric', 'maera-recipes' ); ?></a>
        <a href="?mode=imperial" class="imperial recipe-button"><?php _e( 'Imp.', 'maera-recipes' ); ?></a>
        <a href="?mode=us" class="us recipe-button"><?php _e( 'US', 'maera-recipes' ); ?></a>
    </div>
<?php endif;
