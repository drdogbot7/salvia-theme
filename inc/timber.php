<?php
/**
 * Initializes Timber
 *
 * @package Wordpress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

// use Timber\Timber;

/**
 * Check if Timber is activated
 */

if (!class_exists('Timber')) {
	add_action('admin_notices', function () {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' .
			esc_url(admin_url('plugins.php#timber')) .
			'">' .
			esc_url(admin_url('plugins.php')) .
			'</a></p></div>';
	});
	return;
}

add_filter('timber/context', 'add_to_context');

function add_to_context($context)
{
	/* Menu */
	$context['menu'] = Timber::get_menu('primary_navigation');
	/* Site info */
	$context['sidebar_footer'] = Timber::get_widgets('sidebar_footer');
	/* Debugging */
	if (in_array(WP_DEBUG, ['true', 'TRUE', 1])) {
		$context['debug'] = true;
	}
	return $context;
}
