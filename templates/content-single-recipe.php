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
		<?php
		$header_elements = get_theme_mod( 'recipe_elements_order_header', array(
			'title',
			'featured-image',
			'intro',
			'general-info',
		) );

		foreach ( $header_elements as $header_element ) {
			recipes()->get_template_part( 'content', 'single-recipe-' . $header_element );
		}
		?>

	</header>

	<div class="entry-content">

		<?php
		$header_elements = get_theme_mod( 'recipe_elements_order_content', array(
			'content',
			'execution',
		) );

		foreach ( $header_elements as $header_element ) {
			recipes()->get_template_part( 'content', 'single-recipe-' . $header_element );
		}
		?>

	</div>

</div>
