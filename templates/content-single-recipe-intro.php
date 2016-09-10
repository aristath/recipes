<?php
/**
 * The Template for displaying the intro for single recipes.
 * This template can be overridden by copying it to yourtheme/recipes/content-single-recipe-intro.php.
 *
 * @author 		Aristeides Stathopoulos
 * @package 	Recipes/Templates
 * @version     1.1.0
 */

?>
<?php $intro_style = get_theme_mod( 'recipes_intro_style', 'blockquote' ); ?>
<div class="recipe-intro" itemprop="recipe-description">
	<?php if ( 'blockquote' === $intro_style ) : ?>
		<blockquote><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'description', true ) ); ?></blockquote>
	<?php elseif ( 'custom' === $intro_style ) : ?>
		<div class="recipe-intro"><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'description', true ) ); ?></div>
	<?php endif; ?>
</div>
