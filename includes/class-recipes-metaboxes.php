<?php

if ( ! class_exists( 'Recipes_Metaboxes' ) ) {
	class Recipes_Metaboxes {

		/**
		 * Constructor.
		 * Contains all hooks & actions needed.
		 *
		 * @access public
	     */
	    public function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );

	    }

		/**
		 * Adds the meta box container.
		 *
		 * @access public
		 * @param string $post_type Thje post type.
	     */
	    public function add_meta_box( $post_type ) {

	        if ( 'recipe' === $post_type ) {
				add_meta_box(
	                'some_meta_box_name',
	                __( 'Some Meta Box Headline', 'textdomain' ),
	                array( $this, 'render_meta_box_content' ),
	                $post_type,
	                'advanced',
	                'high'
	            );
	        }
	    }

	    /**
	     * Save the meta when the post is saved.
		 *
		 * @access public
	     * @param int $post_id The ID of the post being saved.
	     */
	    public function save( $post_id ) {

	        // Check if our nonce is set.
	        if ( ! isset( $_POST['recipes_inner_custom_box_nonce'] ) ) {
	            return $post_id;
	        }

	        // Verify that the nonce is valid.
	        if ( ! wp_verify_nonce( $_POST['recipes_inner_custom_box_nonce'], 'recipes_inner_custom_box' ) ) {
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
	        $mydata = sanitize_text_field( $_POST['myplugin_new_field'] );

	        // Update the meta field.
	        update_post_meta( $post_id, '_my_meta_value_key', $mydata );
	    }


	    /**
	     * Render Meta Box content.
	     *
		 * @access public
	     * @param WP_Post $post The post object.
	     */
	    public function render_meta_box_content( $post ) {

	        // Add an nonce field so we can check for it later.
	        wp_nonce_field( 'recipes_inner_custom_box', 'recipes_inner_custom_box_nonce' );

	        // Use get_post_meta to retrieve an existing value from the database.
	        $value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	        // Display the form, using the current value.
	        ?>
	        <label for="myplugin_new_field">
	            <?php _e( 'Description for this field', 'textdomain' ); ?>
	        </label>
	        <input type="text" id="myplugin_new_field" name="myplugin_new_field" value="<?php echo esc_attr( $value ); ?>" size="25" />
	        <?php
	    }
	}
}
