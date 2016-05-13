<?php

global $post;
$settings = get_option( 'recipes' );
?>
<?php if ( current_user_can( 'edit_post', $post->ID ) ) : ?>
    <button class="show-recipe-edit-form"><?php _e( 'Edit recipe', 'recipes' ); ?></button>
<?php endif; ?>

<?php if ( current_user_can( 'edit_post', $post->ID ) ) : ?>
    <div class="recipe-edit-form" style="display: none;">
        <?php acf_form(); ?>
    </div>
<?php endif; ?>

<script>
    (function($) { $(function() {
        $( ".show-recipe-edit-form" ).click( function() {
            $( ".recipe-edit-form" ).toggle();
        });
    }); })(jQuery);
</script>
