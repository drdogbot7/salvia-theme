<?php
/**
 * Salvia Theme
 *
 * The $salvia_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Missing files will produce a fatal error.
 *
 * @package WordPress
 * @subpackage Timber
 * @since 1.0.0
 */

/**
 * Load Timber
 */
require_once __DIR__ . '/vendor/autoload.php';

$timber = new Timber\Timber();

$salvia_includes = [
	'inc/setup.php', // Theme setup
	'inc/queries.php', // Modify queries
	'inc/plugins.php', // plugin related
	'inc/timber.php', // Twig magic
];

foreach ($salvia_includes as $file) {
	if (!($filepath = locate_template($file))) {
		trigger_error(
			sprintf(__('Error locating %s for inclusion', 'sage'), $file),
			E_USER_ERROR
		);
	}

	require_once $filepath;
}
unset($file, $filepath);