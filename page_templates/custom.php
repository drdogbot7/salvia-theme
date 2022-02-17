<?php
/**
 * Template Name: Custom
 * Description: A custom page template
 *
 * @package WordPress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

$context = Timber::context();
$timber_post = Timber::get_post();
$context['post'] = $timber_post;

Timber::render(['custom.twig', 'page.twig'], $context);