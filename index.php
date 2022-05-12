<?php
/**
 * The default template.
 *
 * @package WordPress
 * @subpackage Timber
 * @since 1.0.0
 */

$context = Timber::context();

Timber::render('index.twig', $context);