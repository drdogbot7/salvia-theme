<?php
/**
 * The template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Timber
 * @since 1.0.0
 */

$context = Timber::get_context();
// using Timber::query_post instead of Timber::get_post
// to make post pagination to work
$timber_post = Timber::query_post();
// $timber_post     = Timber::query_post();
$context['post'] = $timber_post;

if (post_password_required($timber_post->ID)) {
	Timber::render('single-password.twig', $context);
} else {
	Timber::render(
		[
			'single-' . $timber_post->ID . '.twig',
			'single-' . $timber_post->post_type . '.twig',
			'single-' . $timber_post->slug . '.twig',
			'single.twig',
		],
		$context
	);
}