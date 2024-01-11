<?php
/**
 * Template Name: No Title
 * Description: A wide page template
 *
 */

$context = Timber::context();
$timber_post = Timber::get_post();
$context['post'] = $timber_post;

Timber::render(['no-title.twig', 'page.twig'], $context);