<?php

/**
 * Add postMessage support
 */
function customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->add_section('theme_options', [
		'title' => __('Theme Options'),
	]);
	$wp_customize->add_setting('site_copyright_text', [
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', // Basically to_json.
	]);
	$wp_customize->add_control('site_copyright_text', [
		'label' => __('Copyright Text'),
		'type' => 'textarea',
		'section' => 'theme_options',
	]);
	$wp_customize->add_setting('site_footer_text', [
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', // Basically to_json.
	]);
	$wp_customize->add_control('site_footer_text', [
		'label' => __('Footer Text (appears below copyright)'),
		'type' => 'textarea',
		'section' => 'theme_options',
	]);
	$wp_customize->add_setting('site_scripts', [
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', // Basically to_json.
	]);
	$wp_customize->add_control('site_scripts', [
		'label' => __('Scripts'),
		'type' => 'textarea',
		'section' => 'theme_options',
	]);
}
add_action('customize_register', 'customize_register');

/**
 * Customizer JS
 */
// function customize_preview_js() {
//   wp_enqueue_script('customizer', Assets\asset_path('customizer.js'), ['customize-preview'], null, true);
// }
// add_action('customize_preview_init', 'customize_preview_js');
