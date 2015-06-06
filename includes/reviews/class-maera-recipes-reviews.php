<?php
/**
* Plugin Name: Comment Rating Field Plugin
*/

class Maera_Recipes_Reviews {

    public $url       = null;
    public $post_type = 'post';

    /**
     * The class contructor
     */
    public function __construct( $post_type = 'post' ) {

        $this->url       = trailingslashit( MAERA_RECIPES_URL ) . 'includes/reviews';
        $this->post_type = $post_type;

        add_action( 'comment_post', array( $this, 'save_rating' ) );
	    add_action( 'comment_text', array( $this, 'display_rating' ) );

        if ( is_admin() ) {
        	add_action( 'wp_set_comment_status', array( $this, 'update_post_rating_by_comment_id' ) );
            add_action( 'deleted_comment', array( $this, 'update_post_rating_by_comment_id' ) );
        } else {
        	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        	add_action( 'comment_form_logged_in_after', array( $this, 'display_rating_field' ) );
	        add_action( 'comment_form_after_fields', array( $this, 'display_rating_field' ) );
        }

    }

    /**
     * Enqueue scripts and styles
     */
    function enqueue() {
        wp_enqueue_style( 'dashicons' );
    	wp_enqueue_script( 'comment_rating-rating', trailingslashit( $this->url ) . 'js/jquery.rating.pack.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'comment_rating-frontend', trailingslashit( $this->url ) . 'js/frontend.js', array( 'jquery' ), false, true );
        wp_enqueue_style( 'comment_rating-rating', trailingslashit( $this->url ) . 'css/rating.css', array(), false );
    }

	/**
     * Save the rating
     *
     * @var int     comment ID
     */
    function save_rating( $comment_id ) {
        add_comment_meta( $comment_id, 'comment_rating-rating', $_POST['comment_rating-rating'], true);
        $this->update_post_rating_by_comment_id( $comment_id );
    }

    /**
     * Calculates the average rating and total number of ratings
     * for the given post ID, storing it in the post meta.
     *
     * @var int     post ID
     */
    function update_post_rating_by_post_id( $post_id ) {
    	global $wpdb;

		$comments = get_comments( array(
			'post_id' => $post_id,
			'status'  => 'approve',
		) );

		$total_rating   = 0;
		$total_ratings  = 0;
        $average_rating = 0;
        if ( is_array( $comments ) && 0 < count( $comments ) ) {
			foreach ( $comments as $comment ) {
                $rating = get_comment_meta( $comment->comment_ID, 'comment_rating-rating', true );
                if ( 0 < $rating ) {
					$total_ratings++;
					$total_rating += $rating;
				}
	        }

	        $average_rating = ( ( $total_ratings == 0 ) ? 0 : round( ( ( $total_rating / $total_ratings ) * 2 ), 0 ) / 2 );
        }

        update_post_meta( $post_id, 'comment_rating-total-ratings', $total_ratings );
        update_post_meta( $post_id, 'comment_rating-average-rating', $average_rating );

		return true;

    }

    /**
     * Returns a count of comments that have a vote.
     */
    public static function count_votes( $post_id ) {
        global $wpdb;

		$comments = get_comments( array(
			'post_id' => $post_id,
			'status'  => 'approve',
		) );

		$total_ratings  = 0;
        if ( is_array( $comments ) && 0 < count( $comments ) ) {
			foreach ( $comments as $comment ) {
                $rating = get_comment_meta( $comment->comment_ID, 'comment_rating-rating', true );
                if ( 0 < $rating ) {
					$total_ratings++;
				}
	        }
        }
        return $total_ratings;
    }

    function update_post_rating_by_comment_id( $comment_id ) {

    	$comment = get_comment( $comment_id );
    	$this->update_post_rating_by_post_id( $comment->comment_post_ID );
    	return true;

    }

    function can_have_rating() {
		global $post;
    	wp_reset_query();
    	if ( ! is_singular() || 'open' != $post->comment_status ) {
            return;
        }
    	if ( $this->post_type == get_post_type( $post->ID ) ) {
    		return true;
        }
    	return false;

    }

    /**
     * Appends the rating to the beginning of the comment text for the given comment ID
     *
     * @var string the comment
     */
    function display_rating( $comment ) {

        global $post;

        $comment_id = get_comment_ID();

        if ( ! isset( $this->display ) || ! $this->display ) {
            $this->display = $this->can_have_rating();
        }

        if ( ! $this->display ) {
            return $comment;
        }

        $rating = get_comment_meta( $comment_id, 'comment_rating-rating', true );
        $rating = ( '' == $rating ) ? 0 : $rating;

        // Calculate the number of each type of star needed
    	$full_stars  = floor( $rating );
    	$half_stars  = ceil( $rating - $full_stars );
    	$empty_stars = 5 - $full_stars - $half_stars;

        $title        = '';
        $simple_title = '';

    	$template  = '<div class="star-rating">';
        for ( $i = 1; $i <= 5; $i++ ) {
            if ( $i <= $rating ) {
                $template .= '<span class="star star-full star-' . $i . '"></span>';
            } elseif ( $half_stars && $i < $rating + 1 ) {
                $template .= '<span class="star star-half star-' . $i . '"></span>';
            } else {
                $template .= '<span class="star star-empty star-' . $i . '"></span>';
            }
        }
        $template .= '</div>';

        return $template . $comment;

    }

    /**
     * Appends the rating field to the end of the comment form, if required
     */
    function display_rating_field() {

        if ( ! $this->can_have_rating() ) {
            return;
        }
    	?>
		<p class="comment_rating-field">
        	<label for="rating-star">RATING LABEL</label>
	        <input name="rating-star" type="radio" class="star" value="1" />
	        <input name="rating-star" type="radio" class="star" value="2" />
	        <input name="rating-star" type="radio" class="star" value="3" />
	        <input name="rating-star" type="radio" class="star" value="4" />
	        <input name="rating-star" type="radio" class="star" value="5" />
	        <input type="hidden" name="comment_rating-rating" value="0" />
	    </p>
		<?php
    }

}
