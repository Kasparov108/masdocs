<?php
/**
 * masDocs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package masDocs
 */

$theme           = wp_get_theme( 'masdocs' );
$masdocs_version = $theme['Version'];

if ( ! function_exists( 'masdocs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function masdocs_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on masDocs, use a find and replace
		 * to change 'masdocs' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'masdocs', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'masdocs' ),
		) );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'masdocs_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'masdocs_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function masdocs_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'masdocs_content_width', 640 );
}
add_action( 'after_setup_theme', 'masdocs_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function masdocs_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'masdocs' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'masdocs' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'masdocs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function masdocs_scripts() {
	global $masdocs_version;

	wp_dequeue_style( 'wedocs-styles' );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'masdocs-style', get_stylesheet_uri() );
	wp_enqueue_style( 'masdocs-wedocs-styles', get_template_directory_uri() . '/assets/css/wedocs/wedocs.css' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$suffix = '';
	
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array( 'jquery' ), $masdocs_version, true );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap' . $suffix . '.js', array( 'jquery', 'popper' ), $masdocs_version, true );
	wp_enqueue_script( 'anchors_js', get_template_directory_uri() . '/assets/js/anchor' . $suffix . '.js', array( 'jquery', 'popper' ), $masdocs_version, true );
	wp_enqueue_script( 'masdocs_js', get_template_directory_uri() . '/assets/js/masdocs'. $suffix . '.js', array( 'bootstrap_js' ), $masdocs_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'masdocs_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( class_exists( 'WeDocs' ) ) {
	require get_template_directory() . '/inc/wedocs/masdocs-wedocs-functions.php';
	require get_template_directory() . '/inc/wedocs/masdocs-wedocs-template-functions.php';
	require get_template_directory() . '/inc/wedocs/masdocs-wedocs-template-hooks.php';
}

require get_template_directory() . '/inc/class-masdocs-shortcodes.php';

add_action( 'init', array( 'Masdocs_Shortcodes', 'init' ) );