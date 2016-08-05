<?php

if ( ! class_exists( 'Recipes_Metabox_Ingredients' ) ) {

	/**
	 * The ingredients metabox.
	 */
	class Recipes_Metabox_Ingredients extends Recipes_Metabox {

		/**
		 * Constructor.
		 *
		 * @access public
		 */
		public function __construct() {

			$this->metabox_args = array(
				'id'       => 'recipe_ingredients',
				'title'    => esc_attr__( 'Recipe Ingredients', 'recipes' ),
				'context'  => 'above-editor',
				'priority' => 'high',
			);
			$this->template['id'] = 'recipe-ingredients';
			parent::__construct();

		}

		/**
		 * Save the meta when the post is saved.
		 *
		 * @since 1.0.0
		 * @access public
		 * @param int $post_id The ID of the post being saved.
		 */
		public function save( $post_id ) {

			// Check if our nonce is set.
			if ( ! isset( $_POST['recipes_ingredients_nonce'] ) ) {
				return $post_id;
			}

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $_POST['recipes_ingredients_nonce'], 'recipes_inner_custom_box' ) ) {
				return $post_id;
			}

			// If this is an autosave, our form has not been submitted,
			// so we don't want to do anything.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}

			// Check the user's permissions.
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}

			// Sanitize the user input.
			$ingredients = $_POST['ingredients'];

			if ( is_array( $ingredients ) ) {
				$sanitized_ingredients = array();
				foreach ( $ingredients as $ingredient ) {
					$ingredient = trim( $ingredient );
					if ( ! empty( $ingredient ) ) {
						$sanitized_ingredients[] = wp_strip_all_tags( $ingredient, true );
					}
				}
			}

			// Update the meta field.
			update_post_meta( $post_id, 'ingredients', $sanitized_ingredients );

		}

		/**
		 * Render Meta Box content.
		 *
		 * @since 1.0.0
		 * @access public
		 * @param WP_Post $post The post object.
		 */
		public function callback( $post ) {

			$this->template['path'] = 'template-ingredients.php';
			$this->template['data']['l10n'] = array(
				'ingredient'  => esc_attr__( 'Ingredient', 'recipes' ),
				'add'         => esc_attr__( 'Add New Ingredient', 'recipes' ),
				'description' => esc_attr__( 'Please add the ingredients for your recipe below. Use a single line for each ingredient (Example: 1/2 Kg Potatoes) and press the "Add new ingredient" button if you want to add a new ingredient. Empty fields will be automatically removed on save.', 'recipes' ),
			);
			$this->template['data']['value'] = get_post_meta( $post->ID, 'ingredients', true );
			if ( empty( $this->template['data']['value'] ) ) {
				$this->template['data']['value'] = array( '' );
			}

			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'recipes_inner_custom_box', 'recipes_ingredients_nonce' );

			echo '<div id="' . esc_attr( $this->template['id'] ) . '"></div>';

		}
	}
}
