<?php
/**
 * Template for displaying 404 pages
 *
 * @package WordPress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

$context = Timber::get_context();
Timber::render('404.twig', $context);