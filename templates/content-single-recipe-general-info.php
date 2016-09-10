<?php
/**
 * The Template for displaying the general info for single recipes.
 * This template can be overridden by copying it to yourtheme/recipes/content-single-recipe-general-info.php.
 *
 * @author 		Aristeides Stathopoulos
 * @package 	Recipes/Templates
 * @version     1.1.0
 */

?>
<div class="recipe-general-info">

	<?php $servings  = get_post_meta( get_the_ID(), 'servings', true ); ?>
	<?php $prep_time = get_post_meta( get_the_ID(), 'prep_time', true ); ?>
	<?php $cook_time = get_post_meta( get_the_ID(), 'cook_time', true ); ?>

	<?php if ( $prep_time ) : ?>
		<div class="recipe-general-info-element prep-time">
			<?php printf( esc_html__( '%1$s Prep time: %2$s min', 'recipes' ), '<span class="dashicons dashicons-clock"></span>', '<time datetime="PT' . absint( $prep_time ) . 'M" itemprop="prepTime">' . absint( $prep_time ) . '</time>' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $cook_time ) : ?>
		<div class="recipe-general-info-element cook-time">
			<?php printf( esc_html__( '%1$s Cook time: %2$s min', 'recipes' ), '<span class="dashicons dashicons-clock"></span>', '<time datetime="PT' . absint( $cook_time ) . 'M" itemprop="cookTime">' . absint( $cook_time ) . '</time>' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $prep_time && $cook_time ) : ?>
		<div class="recipe-general-info-element total-time">
			<?php $total_time = absint( $prep_time ) + absint( $cook_time ); ?>
			<?php printf( esc_html__( '%1$s Total time: %2$s min', 'recipes' ), '<span class="dashicons dashicons-clock"></span>', '<time datetime="PT' . absint( $total_time ) . '" itemprop="totalTime">' . absint( $total_time ) . '</time>' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $servings ) : ?>
		<div class="recipe-general-info-element servings">
			<?php printf( esc_html__( '%1$s Yield: %2$s servings', 'recipes' ), '<span class="dashicons dashicons-groups"></span>', '<span itemprop="recipeYield">' . absint( $servings ) . '</span>' ); ?>
		</div>
	<?php endif; ?>

</div>
