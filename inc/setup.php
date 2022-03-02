<?php
/**
 * Sets up theme and enqueues assets
 *
 * @package Wordpress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

// Clean up wordpres <head>
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/**
 * Theme assets
 */
use function BenTools\WebpackEncoreResolver\encore_entry_css_files;
use function BenTools\WebpackEncoreResolver\encore_entry_js_files;

add_action('wp_enqueue_scripts', 'salvia_enqueue_front', 100);

function salvia_enqueue_front()
{
	$asset = include get_template_directory() . '/build/index.asset.php';
	wp_enqueue_script(
		'salvia_js',
		get_template_directory() . '/build/index.js',
		$asset_file['dependencies'],
		$asset_file['version']
	);
	wp_enqueue_style(
		'salvia_css',
		get_template_directory() . '/build/index.css',
		$asset_file['dependencies'],
		$asset_file['version']
	);
}

/**
 * Theme Editor assets
 */
add_action('enqueue_block_editor_assets', 'salvia_enqueue_editor_assets', 100);
function salvia_enqueue_editor_assets()
{
	$asset = include get_template_directory() . '/build/editor.asset.php';
	wp_enqueue_script(
		'salvia_editor_js',
		get_template_directory() . '/build/editor.js',
		$asset_file['dependencies'],
		$asset_file['version']
	);
	wp_enqueue_style(
		'salvia_editor_css',
		get_template_directory() . '/build/editor.css',
		$asset_file['dependencies'],
		$asset_file['version']
	);
}

/**
 * Theme setup
 */
add_action(
	'after_setup_theme',
	function () {
		/**
		 * Enable plugins to manage the document title
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
		 */
		add_theme_support('title-tag');
		/**
		 * Register navigation menus
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */
		register_nav_menus([
			'primary_navigation' => 'Primary Navigation',
		]);
		/**
		 * Register widget areas
		 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
		 */
		register_sidebar([
			'id' => 'sidebar_footer',
			'name' => 'Footer Sidebar',
			'before_widget' => '<div>',
			'after_widget' => '</div>',
		]);
		/**
		 * Enable post thumbnails
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		/**
		 * Enable HTML5 markup support
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support('html5', [
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		]);
		/**
		 * Enable selective refresh for widgets in customizer
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
		 */
		add_theme_support('customize-selective-refresh-widgets');

		add_theme_support('responsive-embeds');
	},
	20
);

// Add page slug to body class
add_filter('body_class', 'add_slug_to_body_class');

function add_slug_to_body_class($classes)
{
	global $post;
	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	} elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	} elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}
	return $classes;
}