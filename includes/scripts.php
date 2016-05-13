<?php

function recipes_scripts() {
	wp_enqueue_style( 'recipes', trailingslashit( RECIPES_URL ) . 'assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'recipes_scripts' );
