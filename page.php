<?php
/**
 * The template for displaying all pages.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 *
 * @package WordPress
 * @subpackage Timber
 * @since 1.0.0
 */

$context = Timber::context();

if (post_password_required($timber_post->ID)) {
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