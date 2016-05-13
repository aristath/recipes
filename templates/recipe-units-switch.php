<?php

global $post;
$settings = get_option( 'recipes' );
?>
<?php if ( isset( $settings['display_units_converter'] ) && $settings['display_units_converter'] ) : ?>
    <div class="units-switch <?php echo ( isset( $_GET['mode'] ) ) ? $_GET['mode'] : ''; ?>">
        <a href="?mode=metric" class="metric recipe-button"><?php _e( 'Metric', 'recipes' ); ?></a>
        <a href="?mode=imperial" class="imperial recipe-button"><?php _e( 'Imp.', 'recipes' ); ?></a>
        <a href="?mode=us" class="us recipe-button"><?php _e( 'US', 'recipes' ); ?></a>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
<?php endif;
