<?php


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

add_action('wp_enqueue_scripts', function () {
    $asset_path = get_stylesheet_directory() . '/dist';
    $css_assets = encore_entry_css_files('app', $asset_path);
    $js_assets = encore_entry_js_files('app', $asset_path);
    foreach ($css_assets as $key=>$resource) {
        wp_enqueue_style('theme-css-' . $key, $resource, false, null);
    }
    foreach ($js_assets as $key=>$resource) {
        wp_enqueue_script('theme-js-' . $key, $resource, ['jquery'], false, true);
    }
}, 100);

/**
 * Theme Editor assets
 */
// add_action('enqueue_block_editor_assets', function () {
//     $asset_path = get_stylesheet_directory() . '/dist';
//     $css_assets = encore_entry_css_files('editor', $asset_path);
//     $js_assets = encore_entry_js_files('editor', $asset_path);
//     foreach ($css_assets as $key=>$resource) {
//         wp_enqueue_style('theme-editor-css-' . $key, $resource, false, null);
//     }
//     foreach ($js_assets as $key=>$resource) {
//         wp_enqueue_script('theme-editor-js-' . $key, $resource, ['jquery'], false, true);
//     }
// }, 100);


/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
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
        'primary_navigation' => 'Primary Navigation'
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
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support( 'responsive-embeds' );
}, 20);

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
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