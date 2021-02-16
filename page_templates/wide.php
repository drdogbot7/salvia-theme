<?php
/**
 * Template Name: Wide
 * Description: A wide page template
 *
 * @package WordPress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

$context = Timber::get_context();

Timber::render(['wide.twig', 'page.twig'], $context);