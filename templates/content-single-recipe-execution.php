<?php
/**
 * The Template for displaying the execution instructions for single recipes.
 * This template can be overridden by copying it to yourtheme/recipes/content-single-recipe-execution.php.
 *
 * @author 		Aristeides Stathopoulos
 * @package 	Recipes/Templates
 * @version     1.1.0
 */

?>
<div class="recipe-execution-wrapper">

	<?php $ingredients = get_post_meta( get_the_ID(), 'ingredients', true ); ?>
	<?php if ( ! empty( $ingredients ) ) : ?>
		<div class="ingredients">
			<h3><?php esc_attr_e( 'Ingredients', 'recipes' ); ?></h3>
			<ul>
				<?php foreach ( $ingredients as $ingredient ) : ?>
					<li itemprop="recipeIngredient"><?php echo esc_html( $ingredient ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php $steps = get_post_meta( get_the_ID(), 'steps', true ); ?>
	<?php if ( ! empty( $steps ) ) : ?>
		<div class="steps">
			<h3><?php esc_attr_e( 'Steps', 'recipes' ); ?></h3>
			<ol itemprop="recipeInstructions">
				<?php foreach ( $steps as $step ) : ?>
					<li><?php echo wp_kses_post( $step ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

</div>
