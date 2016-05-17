<?php
/**
 * The Template for displaying all single recipes.
 * This template can be overridden by copying it to yourtheme/recipes/single-recipe.php.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		Aristeides Stathopoulos
 * @package 	Recipes/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php recipes()->get_template_part( 'content', 'single-recipe' ); ?>
<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer();
