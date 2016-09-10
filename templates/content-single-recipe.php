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

		<?php recipes()->get_template_part( 'content', 'single-recipe-title' ); ?>
		<?php recipes()->get_template_part( 'content', 'single-recipe-intro' ); ?>
		<?php recipes()->get_template_part( 'content', 'single-recipe-general-info' ); ?>

	</header>

	<div class="entry-content">

		<?php recipes()->get_template_part( 'content', 'single-recipe-content' ); ?>
		<?php recipes()->get_template_part( 'content', 'single-recipe-execution' ); ?>

	</div>

</div>
