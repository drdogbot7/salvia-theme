<?php
/**
 * Template Name: Wide
 * Description: A wide page template
 */

$context = Timber::get_context();

Timber::render( ['wide.twig', 'page.twig'], $context);