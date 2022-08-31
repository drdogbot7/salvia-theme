<?php
/**
 * The default template.
 *
 */

$context = Timber::context();

$templates = ['index.twig'];

if (is_home()) {
	array_unshift($templates, 'home.twig');
}

if (is_front_page()) {
	array_unshift($templates, 'front_page.twig');
}

Timber::render($templates, $context);