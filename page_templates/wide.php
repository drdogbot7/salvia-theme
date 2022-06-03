<?php
/**
 * Template Name: Wide
 * Description: A wide page template
 *
 */

$context = Timber::context();
$timber_post = Timber::get_post();
$context['post'] = $timber_post;

Timber::render(['wide.twig', 'page.twig'], $context);