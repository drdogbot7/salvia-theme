<?php
/**
 * Initializes Timber
 *
 * @package Wordpress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

$timber = new Timber\Timber();

/**
 * Check if Timber is activated
 */

if (!class_exists('Timber')) {
	add_action('admin_notices', function () {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' .
			esc_url(admin_url('plugins.php#timber')) .
			'">' .
			esc_url(admin_url('plugins.php')) .
			'</a></p></div>';
	});
	return;
}

/**
 * Timber
 */

class SalviaTheme extends TimberSite
{
	public function __construct()
	{
		add_filter('timber_context', [$this, 'add_to_context']);
		parent::__construct();
	}
	public function add_to_context($context)
	{
		/* Menu */
		$context['menu'] = new TimberMenu('primary_navigation');

		/* Site info */
		$context['site'] = $this;

		$context['sidebar_footer'] = Timber::get_widgets('sidebar_footer');

		/* Theme Options */
		$context['options']['copyright_text'] = carbon_get_theme_option(
			'crb_copyright_text'
		);
		$context['options']['footer_text'] = carbon_get_theme_option(
			'crb_footer_text'
		);

		/* Debugging */
		if (
			in_array(WP_DEBUG, ['true', 'TRUE', 1]) &&
			class_exists('Ajgl\Twig\Extension\BreakpointExtension')
		) {
			$context['debug'] = true;
		}

		return $context;
	}
}
new SalviaTheme();
