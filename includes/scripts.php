<?php

function recipes_scripts() {
	wp_enqueue_style( 'recipes', trailingslashit( RECIPES_URL ) . 'assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'recipes_scripts' );

/**
 * Enqueue a script in the WordPress admin, excluding edit.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function recipes_admin_scripts( $hook ) {
	if ( 'post.php' != $hook ) {
		return;
	}
	wp_enqueue_script( 'jquery-repeater', trailingslashit( RECIPES_URL ) . 'assets/js/vendor/jquery.repeater.js', array( 'jquery' ) );
	wp_enqueue_script( 'recipes', trailingslashit( RECIPES_URL ) . 'assets/js/recipes-admin.js', array( 'jquery', 'jquery-repeater' ) );
}
add_action( 'admin_enqueue_scripts', 'recipes_admin_scripts' );
