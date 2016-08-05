<?php

if ( ! class_exists( 'Recipes_Metabox_Steps' ) ) {

	/**
	 * The Steps metabox.
	 */
	class Recipes_Metabox_Steps extends Recipes_Metabox {

		/**
		 * Constructor.
		 *
		 * @access public
		 */
		public function __construct() {

			$this->metabox_args = array(
				'id'       => 'recipe_steps',
				'title'    => esc_attr__( 'Recipe Steps', 'recipes' ),
				'context'  => 'above-editor',
				'priority' => 'high',
			);
			$this->template['id'] = 'recipe-steps';
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
			if ( ! isset( $_POST['recipes_steps_nonce'] ) ) {
				return $post_id;
			}

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $_POST['recipes_steps_nonce'], 'recipes_inner_custom_box' ) ) {
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
			$steps = $_POST['steps'];

			if ( is_array( $steps ) ) {
				$sanitized_steps = array();
				foreach ( $steps as $step ) {
					if ( ! empty( $step ) ) {
						$sanitized_steps[] = wp_kses_post( $step );
					}
				}
			}

			// Update the meta field.
			update_post_meta( $post_id, 'steps', $sanitized_steps );

		}

		/**
		 * Render Meta Box content.
		 *
		 * @since 1.0.0
		 * @access public
		 * @param WP_Post $post The post object.
		 */
		public function callback( $post ) {

			$this->template['path'] = 'template-steps.php';
			$this->template['data']['l10n'] = array(
				'step'        => esc_attr__( 'Step', 'recipes' ),
				'add'         => esc_attr__( 'Add Step', 'recipes' ),
				'description' => esc_attr__( 'Please add the steps for your recipe below. Empty fields will be automatically removed on save.', 'recipes' ),
			);
			$this->template['data']['value'] = get_post_meta( $post->ID, 'steps', true );
			if ( empty( $this->template['data']['value'] ) ) {
				$this->template['data']['value'] = array( '' );
			}

			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'recipes_inner_custom_box', 'recipes_steps_nonce' );

			echo '<div id="' . esc_attr( $this->template['id'] ) . '"></div>';

		}
	}
}
