<?php
/**
 * The Template for displaying the content for single recipes.
 * This template can be overridden by copying it to yourtheme/recipes/content-single-recipe.php.
 *
 * @author 		Aristeides Stathopoulos
 * @package 	Recipes/Templates
 * @version     1.0.0
 */

?>

<div class="recipe content" itemscope itemtype="http://schema.org/Recipe">
	<header class="entry-header">
		<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		<div class="recipe-intro" itemprop="recipe-description">
			<blockquote><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'description', true ) ); ?></blockquote>
		</div>
		<div class="recipe-general-info">
			<?php $servings  = get_post_meta( get_the_ID(), 'servings', true ); ?>
			<?php $prep_time = get_post_meta( get_the_ID(), 'prep_time', true ); ?>
			<?php $cook_time = get_post_meta( get_the_ID(), 'cook_time', true ); ?>
			<?php if ( $prep_time ) : ?>
				<?php printf( esc_html__( 'Prep time: %s', 'recipes' ), '<time datetime="PT' . absint( $prep_time ) . 'M" itemprop="prepTime">' . absint( $prep_time ) . ' min</time>' ); ?>
			<?php endif; ?>
			<?php if ( $cook_time ) : ?>
				<?php printf( esc_html__( 'Cook time: %s', 'recipes' ), '<time datetime="PT' . absint( $cook_time ) . 'M" itemprop="cookTime">' . absint( $cook_time ) . ' min</time>' ); ?>
			<?php endif; ?>
			<?php if ( $prep_time || $cook_time ) : ?>
				<?php $total_time = absint( $prep_time ) + absint( $cook_time ); ?>
				<?php printf( esc_html__( 'Total time: %s', 'recipes' ), '<time datetime="PT' . absint( $total_time ) . '" itemprop="totalTime">' . absint( $total_time ) . ' min</time>' ); ?>
			<?php endif; ?>
			<?php if ( $servings ) : ?>
				<?php printf( esc_html__( 'Yield: %s' ), '<span itemprop="recipeYield">' . absint( $servings ) . ' servings</span>' ); ?>
			<?php endif; ?>
		</div>
	</header>

	<div class="entry-content">

		<div class="recipe-content">
			<?php the_content(); ?>
		</div>

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

	</div>
</div>
