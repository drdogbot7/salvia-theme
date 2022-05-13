<?php
/**
 * Salvia Theme
 *
 * @since 2.0.0
 */

require_once __DIR__ . '/vendor/autoload.php';

// Timber Setup
$timber = new Timber\Timber();
add_filter('timber/context', 'salvia_add_to_context');
add_filter('timber/twig', 'salvia_add_to_twig');

// Theme Setup
add_action('after_setup_theme', 'salvia_wp_cleanup');
add_action('after_setup_theme', 'salvia_theme_supports');
add_action('after_setup_theme', 'salvia_menus_widgets');
add_action('after_setup_theme', 'salvia_plugins');
add_action('pre_get_posts', 'salvia_pre_get_posts');

// Enqueue Assets
add_action('wp_enqueue_scripts', 'salvia_enqueue_front', 100);
add_action('enqueue_block_editor_assets', 'salvia_enqueue_editor', 100);

function salvia_add_to_context($context)
{
	$context['menu'] = Timber::get_menu('primary_navigation');
	$context['sidebar_footer'] = Timber::get_widgets('sidebar_footer');

	// show twig debugging if WP_DEBUG enabled
	if (in_array(WP_DEBUG, ['true', 'TRUE', 1])) {
		$context['debug'] = true;
	}

	return $context;
}

function salvia_add_to_twig($twig)
{
	return $twig;
}

function salvia_wp_cleanup()
{
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
}

function salvia_theme_supports()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	]);
	add_theme_support('responsive-embeds');
	remove_theme_support('block-templates'); // is there a way to do this in theme.json
}

function salvia_menus_widgets()
{
	register_nav_menus([
		'primary_navigation' => 'Primary Navigation',
	]);
	register_sidebar([
		'id' => 'sidebar_footer',
		'name' => 'Footer Sidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
	]);
}

function salvia_enqueue_front()
{
	$asset_file = include get_template_directory() . '/build/index.asset.php';
	wp_enqueue_script(
		'salvia_js',
		get_template_directory_uri() . '/build/index.js',
		['jquery'],
		$asset_file['version']
	);
	wp_enqueue_style(
		'salvia_css',
		get_template_directory_uri() . '/build/index.css',
		null,
		$asset_file['version']
	);
}

function salvia_enqueue_editor()
{
	$asset_file = include get_template_directory() . '/build/editor.asset.php';
	wp_enqueue_script(
		'salvia_editor_js',
		get_template_directory_uri() . '/build/editor.js',
		['jquery'],
		$asset_file['version']
	);
	wp_enqueue_style(
		'salvia_editor_css',
		get_template_directory_uri() . '/build/editor.css',
		null,
		$asset_file['version']
	);
}

function salvia_plugins()
{
	// disable autop in Contact Form 7
	add_filter('wpcf7_autop_or_not', '__return_false');
}

function salvia_pre_get_posts($query)
{
	// if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'example' ) ) {
	// 	// Display all posts for a custom post type called 'example'
	// 	$query->set( 'posts_per_page', -1 );
	// 	return;
	// }
}