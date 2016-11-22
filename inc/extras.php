<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CleanResume
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cleanresume_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	if( get_theme_mod( 'active_preloader' ) == '1') {
		$classes[] = 'preloader';
	}

	return $classes;
}
add_filter( 'body_class', 'cleanresume_body_classes' );


// Removing [...] from excerpt
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


// Preloader Function
function cleanresume_preloader($content) {
	if( get_theme_mod( 'active_preloader' ) == '1') :
		$preloader_style = esc_attr(get_theme_mod('preloader_styles'));

		if ( $preloader_style == 'option-1' ) {
			echo '<div class="preloader-overlay"><div id="preloader_1" class="preloader-object"><span></span><span></span><span></span><span></span><span></span></div></div>';
		}
		?>

		<script type="text/javascript">
			var $ = jQuery;
			$(document).ready(function() {

				$('.preloader-object').fadeOut(); // will first fade out the loading animation
				$('.preloader-overlay').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
				$('body').delay(350).removeClass('preloader');
			});
		</script>

		<?php
		return $content;
	endif;
}
add_filter( 'wp_footer', 'cleanresume_preloader' );


// Removing query string from css/js urls
function cleanresume_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'cleanresume_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'cleanresume_remove_wp_ver_css_js', 9999 );

