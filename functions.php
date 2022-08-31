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

// Disable Comments
add_action('init', 'salvia_disable_comments');
add_action('admin_init', 'salvia_disable_comments_admin');

// Add to Timber Context
function salvia_add_to_context($context)
{
	$context['menu']['primary'] = Timber::get_menu('menu_primary');
	$context['widgets']['footer'] = Timber::get_widgets('widgets_footer');

	// set debug true if WP_DEBUG enabled
	if (in_array(WP_DEBUG, ['true', 'TRUE', 1])) {
		$context['env']['debug'] = true;
	} else {
		$context['env']['debug'] = false;
	}

	// Add wordpress environment to context
	$context['env']['type'] = wp_get_environment_type();

	return $context;
}

// Add functions to Twig
function salvia_add_to_twig($twig)
{
	return $twig;
}

// Clean up Wordpress cruft
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

// Wordpress theme supports
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

// Register menus and widgets
function salvia_menus_widgets()
{
	register_nav_menus([
		'menu_primary' => 'Primary Menu',
	]);
	register_sidebar([
		'id' => 'widgets_footer',
		'name' => 'Footer Widgets',
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

function salvia_disable_comments()
{
	// Close comments on the front-end
	add_filter('comments_open', '__return_false', 20, 2);
	add_filter('pings_open', '__return_false', 20, 2);

	// Hide existing comments
	add_filter('comments_array', '__return_empty_array', 10, 2);

	// Remove comments links from admin bar
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}

function salvia_disable_comments_admin()
{
	// Redirect any user trying to access comments page
	global $pagenow;

	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit();
	}

	// Remove comments metabox from dashboard
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

	// Disable support for comments and trackbacks in post types
	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}

	// Remove comments page in menu
	remove_menu_page('edit-comments.php');
}