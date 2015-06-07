<?php

global $post;
$settings = get_option( 'maera_recipes' );
?>
<?php if ( has_post_thumbnail() ) : ?>
    <img itemprop="image" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" />
<?php endif;
