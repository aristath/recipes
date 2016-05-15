<?php

if ( ! class_exists( 'Recipes_Metaboxes' ) ) {
	class Recipes_Metaboxes {

		/**
		 * The form arguments.
		 *
		 * @access protected
		 * @var array
		 */
		protected $metabox_args = array();

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
					$this->metabox_args['id'],
					$this->metabox_args['title'],
					array( $this, 'callback' ),
					$post_type,
					$this->metabox_args['context'],
					$this->metabox_args['priority']
				);
			}
		}

		/**
		 * Save the meta when the post is saved.
		 *
		 * @access public
		 * @param int $post_id The ID of the post being saved.
		 */
		public function save( $post_id ) {}


		/**
		 * Render Meta Box content.
		 *
		 * @access public
		 * @param WP_Post $post The post object.
		 */
		public function callback( $post ) {}
	}
}
