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
		<?php if ( (bool) get_theme_mod( 'recipes_show_featured_image', true ) && has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>

		<?php $intro_style = get_theme_mod( 'recipes_intro_style', 'blockquote' ); ?>
		<?php if ( 'hidden' !== $intro_style ) : ?>
			<div class="recipe-intro" itemprop="recipe-description">
				<?php if ( 'blockquote' === $intro_style ) : ?>
					<blockquote><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'description', true ) ); ?></blockquote>
				<?php elseif ( 'custom' === $intro_style ) : ?>
					<div class="recipe-intro"><?php echo wp_kses_post( get_post_meta( get_the_ID(), 'description', true ) ); ?></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

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
