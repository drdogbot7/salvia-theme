<?php
/**
 * Template Name: Wide
 * Description: A wide page template
 *
 * @package WordPress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

Timber::render(['wide.twig', 'page.twig'], $context);