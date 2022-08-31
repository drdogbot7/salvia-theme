<?php
/**
 * The template for displaying all single posts.
 *
 */

$context = Timber::context();

if (post_password_required($post->ID)) {
	Timber::render('single-password.twig', $context);
} else {
	Timber::render(
		[
			'single-' . $post->ID . '.twig',
			'single-' . $post->post_type . '.twig',
			'single-' . $post->slug . '.twig',
			'single.twig',
		],
		$context
	);
}