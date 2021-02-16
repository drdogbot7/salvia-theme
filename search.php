<?php
/**
 * The template for displaying search results.
 *
 * @package WordPress
 * @subpackage Timber
 * @since 1.0.0
 */
$context = Timber::get_context();

Timber::render('search.twig', $context);