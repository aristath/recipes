<?php $intro_style = get_theme_mod( 'recipes_intro_style', 'blockquote' ); ?>
<?php if ( 'hidden' !== $intro_style ) : ?>
	<div class="recipe-intro" itemprop="recipe-description">
		<?php if ( 'blockquote' === $intro_style ) : ?>
			<blockquote><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'description', true ) ); ?></blockquote>
		<?php elseif ( 'custom' === $intro_style ) : ?>
			<div class="recipe-intro"><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'description', true ) ); ?></div>
		<?php endif; ?>
	</div>
<?php endif;
