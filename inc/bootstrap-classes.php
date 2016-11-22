<?php
/**
 * Bootstrap functions that act dependently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CleanResume
 */


//  Add Bootstrap Responsive Classes to embeds
function bs_embed_html( $html ) {
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'bs_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'bs_embed_html' ); // Jetpack

function bs_custom_youtube_oembed( $code ) {
    if( stripos( $code, 'youtube.com' ) !== FALSE && stripos( $code, 'iframe' ) !== FALSE )
        $code = str_replace( '<iframe', '<iframe class="embed-responsive-item" ', $code );

    return $code;
}
add_filter( 'embed_oembed_html', 'bs_custom_youtube_oembed' );

function bs_custom_vimeo_oembed( $code ) {
    if( stripos( $code, 'vimeo.com' ) !== FALSE && stripos( $code, 'iframe' ) !== FALSE )
        $code = str_replace( '<iframe', '<iframe class="embed-responsive-item" ', $code );

    return $code;
}
add_filter( 'embed_oembed_html', 'bs_custom_vimeo_oembed' );

function bs_custom_soundcloud_oembed( $code ) {
    if( stripos( $code, 'soundcloud.com' ) !== FALSE && stripos( $code, 'iframe' ) !== FALSE )
        $code = str_replace( '<iframe', '<iframe class="embed-responsive-item" ', $code );

    return $code;
}
add_filter( 'embed_oembed_html', 'bs_custom_soundcloud_oembed' );


// Adding Bootstrap features in Comments Form inputs
function bs_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="row"><div class="form-group comment-form-author col-sm-4">' . '<label for="author" class="control-label">' . __( 'Name', 'cleanresume-lite' ) . ( $req ? ' <span class="required text-danger">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email col-sm-4"><label for="email" class="control-label">' . __( 'Email', 'cleanresume-lite' ) . ( $req ? ' <span class="required text-danger">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url col-sm-4"><label for="url" class="control-label">' . __( 'Website', 'cleanresume-lite' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>'        
    );
    
    return $fields;
}
add_filter( 'comment_form_default_fields', 'bs_comment_form_fields' );


// Adding Bootstrap Classes to Textarea
function bs_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment" class="control-label">' . _x( 'Comment', 'noun', 'cleanresume-lite' ) . '</label> 
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-success col-sm-6'; // since WP 4.1
    
    return $args;
}
add_filter( 'comment_form_defaults', 'bs_comment_form' );


// Adding Bootstrap Classes to Search Form
function bs_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<div class="form-group"><label class="screen-reader-text" for="s">' . __( 'Search for:', 'cleanresume-lite' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="Start Typing..." />
	<!--<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'cleanresume-lite' ) .'" />-->
	</div>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'bs_search_form' );


// Adding Bootstrap Classes to Calendar widget
function bs_calendar( $markup ) {
	$markup = str_replace( '<table id="wp-calendar"' , '<table id="wp-calendar" class="table table-bordered"' , $markup ) ;
	return $markup;
}
add_filter( 'get_calendar' , 'bs_calendar' , 2 ) ;


