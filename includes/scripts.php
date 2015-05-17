<?php

function maera_recipes_scripts() {
	wp_enqueue_style( 'maera-recipes', trailingslashit( MAERA_RECIPES_URL ) . 'assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'maera_recipes_scripts' );
