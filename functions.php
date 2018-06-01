<?php
/**
 * Quotes on Dev Starter Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package QOD_Starter_Theme
 */

if ( ! function_exists( 'qod_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function qod_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html( 'Primary Menu' ),
	) );

	// Switch search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // qod_setup
add_action( 'after_setup_theme', 'qod_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function qod_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'qod_content_width', 640 );
}
add_action( 'after_setup_theme', 'qod_content_width', 0 );

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function qod_minified_css( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( file_exists( get_template_directory() . '/build/css/style.min.css' ) ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'qod_minified_css', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function qod_scripts() {
	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'qod-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome-cdn', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '4.4.0' );

	wp_enqueue_script( 'qod-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	/**
	 * @TODO add localize script rest api JavaScript
	 */
	if (function_exists('rest_url')){
		wp_enqueue_script('qod_api', get_template_directory_uri().'/build/js/api.min.js', array('jquery'), false, true);
		//api_vars -- this is a global variable that is an object, converted from array
		wp_localize_script('qod_api','api_vars', array(
			'root_url' => esc_url_raw( rest_url() ),
			'home_url' => esc_url_raw(home_url()),
			'nonce' => wp_create_nonce('wp_rest'), //will later call api_vars.nonce
			'success' => 'Thanks! Your quote submission was received.',
			'failure' => 'There appears to be an error in your submission.  Please try again.'
		));
	}
}
add_action( 'wp_enqueue_scripts', 'qod_scripts' );

/**
 * Stretch goal: Create custom WP endpoint
 * We will create a function 'qod_register_endpoints' that hooks onto 'rest_api_init'
 * 'qod' is the namespace, '/rand' is the endpoint/route??
 * The registered-rest-route is READABLE as per GET method - and to READ it we need to callback with 'get-random' function
 * 
 * Post meta-deta = related to custom fields
 * as per: https://codex.wordpress.org/Custom_Fields
 * Essentially, we will pull a post with get_post using parameters of orderby and post per page -->output is an array
 * THEN, we will grab the meta data using get_post_meta for THAT id of post
 * and then use array_push to push post meta to the post array
 
 */


add_action( 'rest_api_init', 'qod_register_endpoints' );

function qod_register_endpoints() {
    register_rest_route( 'qod', '/rand', array(
        'methods'  => 'GET',
    'callback' => 'get_random'
    ) );
}

/**
 * Get random posts
 * @return array
 */
function get_random() {
  $posts = get_posts( array( 'orderby' => 'rand', 'posts_per_page' => 1) );
  $post_meta = get_post_meta( $posts[0]->ID );
  array_push($posts, $post_meta);

    return $posts;
}

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
 require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom metaboxes generated using the CMB2 library.
 */
require get_template_directory() . '/inc/metaboxes.php';

 /**
 * Custom WP API modifications.
 */
 require get_template_directory() . '/inc/api.php';
 