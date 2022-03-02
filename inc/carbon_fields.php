<?php
use Carbon_Fields\Block;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
	\Carbon_Fields\Carbon_Fields::boot();
}

/**
 * Theme Options
 */
add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
	Container::make('theme_options', __('Theme Options'))
		->add_tab(__('Site Info'), [
			Field::make('text', 'crb_copyright_text', 'Copyright Text')
				->set_attribute('placeholder', get_bloginfo('name'))
				->set_help_text(
					'Appears in footer after copyright year. Defaults to site name.'
				),
			Field::make(
				'text',
				'crb_footer_text',
				'Footer Text'
			)->set_help_text('Appears in footer below copyright.'),
		])
		->add_tab(__('Scripts'), [
			Field::make(
				'header_scripts',
				'crb_header_scripts',
				__('Header Scripts')
			),
			Field::make(
				'footer_scripts',
				'crb_footer_scripts',
				__('Footer Scripts')
			),
		]);
}

/**
 * Page/Post Options
 */
add_action('carbon_fields_register_fields', 'crb_attach_post_meta');
function crb_attach_post_meta()
{
	Container::make('post_meta', 'Page Options')
		->where('post_type', '=', 'page')
		->where('post_id', '!=', get_option('page_for_posts'))
		->add_fields([
			Field::make('checkbox', 'crb_hide_title', 'Hide Page Title')
				->set_option_value('true')
				->set_default_value(null),
		]);
}
