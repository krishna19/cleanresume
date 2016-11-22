<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CleanResume
 */

if ( ! function_exists( 'cleanresume_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function cleanresume_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'cleanresume-lite' ),
		'' . $time_string . ''
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'cleanresume-lite' ),
		'<span class="author vcard"><span class="fa fa-user"></span> ' . esc_html( get_the_author() ) . '</span>'
	);

	echo '<div class="post-meta"><span class="posted-on" title="Posted on" data-toggle="tooltip" data-placement="top"><span class="fa fa-clock-o"></span> ' . $posted_on . '</span><span class="byline"  title="Posted by" data-toggle="tooltip" data-placement="top"> ' . $byline . '</span>'; // WPCS: XSS OK.
	
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'cleanresume-lite' ) );
		if ( $categories_list && cleanresume_categorized_blog() ) {
			printf( '<span class="cat-links" title="Categorized in" data-toggle="tooltip" data-placement="top"><span class="fa fa-folder-open"></span> ' . esc_html__( '%1$s', 'cleanresume-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'cleanresume-lite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links" title="Taged in" data-toggle="tooltip" data-placement="top"><span class="fa fa-tags"></span> ' . esc_html__( '%1$s', 'cleanresume-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( /*! is_single() &&*/ ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link" title="Comment(s)" data-toggle="tooltip" data-placement="top"><span class="fa fa-comments"></span> ';
		comments_popup_link( esc_html__( 'Leave a comment', 'cleanresume-lite' ), esc_html__( '1 Comment', 'cleanresume-lite' ), esc_html__( '% Comments', 'cleanresume-lite' ) );
		echo '</span></div>';
	}

}
endif;

if ( ! function_exists( 'cleanresume_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function cleanresume_entry_footer() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit This Post', 'cleanresume-lite' )
			//the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<div class="edit-link pull-left"><span class="fa fa-edit"></span> ',
		'</div>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cleanresume_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cleanresume_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cleanresume_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cleanresume_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cleanresume_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cleanresume_categorized_blog.
 */
function cleanresume_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cleanresume_categories' );
}
add_action( 'edit_category', 'cleanresume_category_transient_flusher' );
add_action( 'save_post',     'cleanresume_category_transient_flusher' );
