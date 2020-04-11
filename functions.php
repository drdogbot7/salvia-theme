<?php
/**
 * Salvia includes
 *
 * The $salvia_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */
$salvia_includes = [
  'inc/assets.php',     // Asset function
  'inc/setup.php',      // Theme setup
  'inc/titles.php',     // Page titles
  'inc/images.php',      // custom image sizes
  'inc/timber.php',     // Twig magic
];

foreach ($salvia_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);