<?php
/**
 * The Recipes_Metabox parent class.
 *
 * @package Recipes
 */

if ( ! class_exists( 'Recipes_Metabox' ) ) {
	/**
	 * The Recipes_Metabox parent class.
	 */
	class Recipes_Metabox {

		/**
		 * The form arguments.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @var array
		 */
		protected $metabox_args = array();

		/**
		 * The template arguments.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @var array
		 */
		protected $template = array();

		/**
		 * Constructor.
		 * Contains all hooks & actions needed.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );
			if ( ! empty( $this->template ) ) {
				add_action( 'admin_footer', array( $this, 'template' ) );
			}

		}

		/**
		 * Adds the meta box container.
		 *
		 * @since 1.0.0
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
		 * @since 1.0.0
		 * @access public
		 * @param int $post_id The ID of the post being saved.
		 */
		public function save( $post_id ) {}

		/**
		 * Render Meta Box content.
		 *
		 * @since 1.0.0
		 * @access public
		 * @param WP_Post $post The post object.
		 */
		public function callback( $post ) {}

		/**
		 * Adds the underscore.js template.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function template() {
			?>

			<script type="text/javascript">
				jQuery( document ).ready( function() {
					var post_template = wp.template( '<?php echo esc_attr( $this->template['id'] ); ?>' );
					jQuery( '#<?php echo esc_attr( $this->template['id'] ); ?>' ).append( post_template( <?php echo wp_json_encode( $this->template['data'] ); ?> ) );
				} );
			</script>
			<script type="text/html" id="tmpl-<?php echo esc_attr( $this->template['id'] ); ?>">
				<?php include $this->template['path']; ?>
			</script>
			<?php

		}
	}
}
