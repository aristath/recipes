<?php
/**
 * The Template for displaying the featured image for single recipes.
 * This template can be overridden by copying it to yourtheme/recipes/content-single-recipe-featured-image.php.
 *
 * @author 		Aristeides Stathopoulos
 * @package 	Recipes/Templates
 * @version     1.1.0
 */

?>
<?php if ( has_post_thumbnail() ) : ?>
	<?php the_post_thumbnail(); ?>
<?php endif;
