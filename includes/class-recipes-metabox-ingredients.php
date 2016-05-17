<?php

if ( ! class_exists( 'Recipes_Metabox_Ingredients' ) ) {

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
				'context'  => 'normal',
				'priority' => 'high',
			);
			$this->template['id'] = 'recipe-ingredients';
			parent::__construct();
		}
		/**
		 * Save the meta when the post is saved.
		 *
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

			// Update the meta field.
			update_post_meta( $post_id, 'ingredients', $ingredients );
		}

		/**
		 * Render Meta Box content.
		 *
		 * @access public
		 * @param WP_Post $post The post object.
		 */
		public function callback( $post ) {

			$this->template['path'] = 'template-ingredients.php';
			$this->template['data']['l10n'] = array(
				'ingredient' => esc_attr__( 'Ingredient', 'recipes' ),
				'add'        => esc_attr__( 'Add', 'recipes' ),
				'delete'     => esc_Attr__( 'Delete', 'recipes' ),
			);
			$this->template['data']['value'] = get_post_meta( $post->ID, 'ingredients', true );
			if ( empty( $this->template['data']['value'] ) ) {
				$this->template['data']['value'] = array( '' );
			}

			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'recipes_inner_custom_box', 'recipes_ingredients_nonce' );

			echo '<div id="' . $this->template['id'] . '"></div>';
		}
	}
}
