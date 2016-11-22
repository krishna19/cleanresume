<?php
/**
 * CleanResume functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CleanResume
 */

if ( ! function_exists( 'cleanresume_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cleanresume_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on CleanResume, use a find and replace
	 * to change 'cleanresume-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cleanresume-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Add Custom Image Size for Portfolio 
	add_image_size( 'portfolio-thumb', 240, 160 );

	// Add Custom Image Size for Blog 
	add_image_size( 'blog-thumb', 640, 480 );

	// This theme uses wp_nav_menu() in one location.
	//register_nav_menus( array(
	//	'primary' => esc_html__( 'Primary Menu', 'cleanresume-lite' ),
	//) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		//'aside',
		'image',
		'audio',
		'video',
		'quote',
		'link',
	));

	// Set up custom header for theme
	add_theme_support( 'custom-header' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cleanresume_custom_background_args', array(
		'default-color' => 'e5e5e5',
		'default-image' => '',
	)));
}
endif; // cleanresume_setup
add_action( 'after_setup_theme', 'cleanresume_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cleanresume_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cleanresume_content_width', 640 );
}
add_action( 'after_setup_theme', 'cleanresume_content_width', 0 );

/**
 * Enqueue Comments Reply.
 */
function cleanresume_enqueue_comments_reply() {
	if( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'cleanresume_enqueue_comments_reply' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cleanresume_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cleanresume-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'cleanresume_widgets_init' );

/**
 * Enqueue styles & Scripts.
 */

// Enqueue Styles
function cleanresume_enqueue_styles() {
	$body_font = get_theme_mod( 'body_font_family', array() ); 
	$headings_font = get_theme_mod( 'title_font_family', array() );

	if( $body_font ) {
		wp_enqueue_style( 'cleanresume-body-font', '//fonts.googleapis.com/css?family='. $body_font['font-family'] );	
	} else {
		wp_enqueue_style( 'cleanresume-lato', '//fonts.googleapis.com/css?family=Lato:400,700,900' );
	} 

	if ( isset( $headings_font['font-family'] ) ) {
		wp_enqueue_style( 'cleanresume-headings-font', '//fonts.googleapis.com/css?family='. $headings_font['font-family'] );	
	}	
	
	wp_enqueue_style( 'cleanresume-font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css' );
	wp_enqueue_style( 'cleanresume-bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css' );
	wp_enqueue_style( 'cleanresume-animatecss', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css' );
	
	if( get_theme_mod( 'active_portfolio' ) == '1') {
		wp_enqueue_style( 'cleanresume-blueimp-gallery', '//blueimp.github.io/Gallery/css/blueimp-gallery.min.css' );
		//wp_enqueue_style( 'cleanresume-bootstrap-image-gallery', '//raw.githubusercontent.com/blueimp/Bootstrap-Image-Gallery/master/css/bootstrap-image-gallery.min.css' );
	}
	
	wp_enqueue_style( 'cleanresume-primary-style', get_stylesheet_uri() );
}

// Enqueue Scripts
function cleanresume_enqueue_scripts() {	
	wp_enqueue_script( 'cleanresume-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'cleanresume-jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), false, true );
	wp_enqueue_script( 'cleanresume-modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.97074.js', array(), false, true );
	wp_enqueue_script( 'cleanresume-bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js', array(), false, true );

	wp_enqueue_script( 'cleanresume-jquery-appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array(), false, true );
	wp_enqueue_script( 'cleanresume-wow', '//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array(), false, true );
	
	if( get_theme_mod( 'active_portfolio' ) == '1') {
		wp_enqueue_script( 'cleanresume-blueimp-image-gallery', '//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js', array(), false, true );
		//wp_enqueue_script( 'cleanresume-bootstrap-image-gallery', '//raw.githubusercontent.com/blueimp/Bootstrap-Image-Gallery/master/js/bootstrap-image-gallery.min.js', array(), false, true );
	}
	
	if( get_theme_mod( 'about_content_excerpt' ) == '1' || get_theme_mod( 'experience_content_excerpt' ) == '1' || get_theme_mod( 'education_content_excerpt' ) == '1' ) {
		wp_enqueue_script( 'cleanresume-jquery-expander', '//cdnjs.cloudflare.com/ajax/libs/jquery-expander/1.7.0/jquery.expander.min.js', array(), false, true );
	}

	wp_enqueue_script( 'cleanresume-jquery-hoverdir', '//cdn.jsdelivr.net/jquery.hoverdir/1.1.1/jquery.hoverdir.min.js', array(), false, true );
	
	wp_enqueue_script( 'cleanresume-custom-scripts', get_template_directory_uri() . '/assets/js/custom-scripts.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'cleanresume_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'cleanresume_enqueue_scripts' );


/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function cleanresume_add_editor_styles() {
    add_editor_style( get_stylesheet_uri() );
}
add_action( 'init', 'cleanresume_add_editor_styles' );




/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/bootstrap-classes.php';

/**
 * Recommend the Kirki plugin
 */
require get_template_directory() . '/inc/include-kirki.php';

/**
 * Load the Kirki Fallback class
 */
require get_template_directory() . '/inc/kirki-fallback.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Custom PostTyps file.
 */
//require get_template_directory() . '/inc/post-types.php';

/**
 * Load Plugin Activation Class.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/plugins.php';


