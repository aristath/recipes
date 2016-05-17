<div class="recipe content" itemscope itemtype="http://schema.org/Recipe">
	<h1 itemprop="name"><?php the_title(); ?></h1>
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail(); ?>
	<?php endif; ?>

	<div itemprop="recipe-description">
		<?php echo get_post_meta( get_the_ID(), 'description', true ); ?>
	</div>
	<div class="recipe-rating">
		<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
			<span itemprop="ratingValue">4.0</span> stars based on
			<span itemprop="reviewCount">35</span> reviews
		</span>
	</div>
	<div class="recipe-general-info">
		<?php $servings  = get_post_meta( get_the_ID(), 'servings', true ); ?>
		<?php $prep_time = get_post_meta( get_the_ID(), 'prep_time', true ); ?>
		<?php $cook_time = get_post_meta( get_the_ID(), 'cook_time', true ); ?>
		<?php if ( $prep_time ) : ?>
			Prep time: <time datetime="PT<?php echo intval( $prep_time ); ?>M" itemprop="prepTime"><?php echo intval( $prep_time ); ?> min</time>
		<?php endif; ?>
		<?php if ( $cook_time ) : ?>
			Cook time: <time datetime="PT<?php echo intval( $cook_time ); ?>M" itemprop="cookTime"><?php echo intval( $cook_time ); ?> min</time>
		<?php endif; ?>
		<?php if ( $prep_time || $cook_time ) : ?>
			<?php $total_time = absint( $prep_time ) + absint( $cook_time ); ?>
			Total time: <time datetime="PT<?php echo $total_time; ?>" itemprop="totalTime"><?php echo $total_time; ?> min</time>
		<?php endif; ?>
		<?php if ( $servings ) : ?>
			Yield: <span itemprop="recipeYield"><?php echo $servings; ?> servings</span>
		<?php endif; ?>
	</div>
	<div class="recipe-nutrition">
		<span itemprop="nutrition" itemscope itemtype="http://schema.org/NutritionInformation">
			Serving size: <span itemprop="servingSize">1 medium slice</span>
			Calories per serving: <span itemprop="calories">250 cal</span>
			Fat per serving: <span itemprop="fatContent">12 g</span>
		</span>
	</div>
	<?php $ingredients = get_post_meta( get_the_ID(), 'ingredients', true ); ?>
	<?php if ( ! empty( $ingredients ) ) : ?>
		<h4>Ingredients:</h4>
		<ul>
			<?php foreach ( $ingredients as $ingredient ) : ?>
				<li itemprop="recipeIngredient"><?php echo esc_html( $ingredient ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<h3>Directions:</h3>
	<div itemprop="recipeInstructions">
		<?php the_content(); ?>
    </div>
</div>
