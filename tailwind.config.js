const plugin = require('tailwindcss/plugin');

module.exports = {
	prefix: '',
	important: false,
	content: ['./views/**/*.twig'],
	separator: ':',
	theme: {
		/**
		 * Use Wordpress Breakpoints
		 * https://github.com/WordPress/gutenberg/blob/master/packages/base-styles/_breakpoints.scss
		 */
		container: {
			center: true,
		},
		screens: {
			sm: '600px',
			md: '782px',
			lg: '960px',
			xl: '1080px',
			wide: '1280px',
			huge: '1440px',
		},
		extend: {
			fontFamily: {
				display: '"Roboto Slab", sans-serif',
			},
			spacing: {
				content: 'var(--wp--style--global--content-size)',
				wide: 'var(--wp--style--global--wide-size)',
				'wp-gap': 'var(--wp--style--block-gap)',
			},
			fontSize: {
				'wp-small': 'var(--wp--preset--font-size--small)',
				'wp-medium': 'var(--wp--preset--font-size--medium)',
				'wp-large': 'var(--wp--preset--font-size--large)',
				'wp-x-large': 'var(--wp--preset--font-size--x-large)',
			},
		},
	},
	variants: {},
	plugins: [
		require('@tailwindcss/forms'),
		plugin(function ({ addVariant }) {
			addVariant('admin', '.admin-bar &');
		}),
	],
};
