<?php
$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'page-' . $timber_post->ID . '.twig', 'page-' . $timber_post->post_type . '.twig', 'page-' . $timber_post->slug . '.twig', 'page.twig' ), $context );
}