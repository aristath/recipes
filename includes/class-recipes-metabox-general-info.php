<?php

if ( ! class_exists( 'Recipes_Metabox_General_Info' ) ) {
	class Recipes_Metabox_General_Info extends Recipes_Metabox {

		/**
		 * Constructor.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->metabox_args = array(
				'id'       => 'recipe_general_info',
				'title'    => esc_attr__( 'Recipe General Info', 'recipes' ),
				'context'  => 'normal',
				'priority' => 'high',
			);
			$this->template['id'] = 'recipe-general-info-metabox';
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
			if ( ! isset( $_POST['recipes_general_info_nonce'] ) ) {
				return $post_id;
			}

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $_POST['recipes_general_info_nonce'], 'recipes_inner_custom_box' ) ) {
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
			$servings         = absint( $_POST['servings_field'] );
			$preparation_time = absint( $_POST['preparation_time'] );
			$cook_time        = absint( $_POST['cook_time'] );
			$description      = esc_html( $_POST['description'] );

			// Update the meta field.
			update_post_meta( $post_id, 'servings', $servings );
			update_post_meta( $post_id, 'preparation_time', $preparation_time );
			update_post_meta( $post_id, 'cook_time', $cook_time );
			update_post_meta( $post_id, 'description', $description );
		}


		/**
		 * Render Meta Box content.
		 *
		 * @access public
		 * @param WP_Post $post The post object.
		 */
		public function callback( $post ) {

			$this->template['data']['l10n'] = array(
				'servings'    => esc_attr__( 'Servings', 'recipes' ),
				'prepTime'    => esc_attr__( 'Preparation Time (minutes)', 'recipes' ),
				'cookTime'    => esc_attr__( 'Cook Time (minutes)', 'recipes' ),
				'description' => esc_attr__( 'Description', 'recipes' ),
			);

			$this->template['data']['value'] = array(
				'servings'         => get_post_meta( $post->ID, 'servings', true ),
				'preparation_time' => get_post_meta( $post->ID, 'preparation_time', true ),
				'cook_time'        => get_post_meta( $post->ID, 'cook_time', true ),
				'description'      => get_post_meta( $post->ID, 'description', true ),
			);
			$this->template['path'] = 'template-general-info.php';

			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'recipes_inner_custom_box', 'recipes_general_info_nonce' );

			echo '<div id="' . $this->template['id'] . '"></div>';
		}
	}
}
