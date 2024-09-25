<?php

/**
 * photographe_event functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package photographe_event
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Enqueue scripts and styles.
 */
function photographe_event_scripts()
{
	// Charger le fichier CSS principal du thème
	wp_enqueue_style('photographe_event-style', get_stylesheet_uri(), array(), '1.0.0');

	// Charger le fichier CSS sans version dynamique
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));

	// Ajout du style RTL si nécessaire
	wp_style_add_data('theme-style', 'rtl', 'replace');

	// Charger le script de navigation du thème
	wp_enqueue_script('photographe_event-navigation', get_template_directory_uri() . '/js/navigation.js', array(), filemtime(get_template_directory() . '/js/navigation.js'), true);

	// Charger le script personnalisé pour la modale avec version dynamique
	wp_enqueue_script('photographe_event-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), filemtime(get_template_directory() . '/js/scripts.js'), true);

	// Charger le script de réponse aux commentaires, si applicable
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'photographe_event_scripts');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function photographe_event_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on photographe_event, use a find and replace
		* to change 'photographe_event' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('photographe_event', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location. 			modifier
	function register_my_menus()
	{
		register_nav_menus(
			array(
				'menu-principal' => __('Menu Principal'),
			)
		);
	}
	add_action('init', 'register_my_menus');


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'photographe_event_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'photographe_event_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photographe_event_content_width()
{
	$GLOBALS['content_width'] = apply_filters('photographe_event_content_width', 640);
}
add_action('after_setup_theme', 'photographe_event_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function photographe_event_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'photographe_event'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'photographe_event'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'photographe_event_widgets_init');



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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
