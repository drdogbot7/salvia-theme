<?php
/**
 * The template for displaying all pages.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 *
 */

$context = Timber::context();

if (post_password_required($post->ID)) {
	Timber::render('single-password.twig', $context);
} else {
	Timber::render(
		[
			'page-' . $post->ID . '.twig',
			'page-' . $post->post_type . '.twig',
			'page-' . $post->slug . '.twig',
			'page.twig',
		],
		$context
	);
}