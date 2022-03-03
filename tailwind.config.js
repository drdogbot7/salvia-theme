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
		screens: {
			sm: '600px',
			md: '782px',
			lg: '960px',
			xl: '1080px',
		},
		container: {
			center: true,
		},
		extend: {
			fontFamily: {
				display: '"Roboto Slab", sans-serif',
			},
		},
	},
	variants: {},
	corePlugins: {
		fontSize: false,
	},
	plugins: [
		require('@tailwindcss/forms'),
		require('tailwindcss-fluid-type'),
		plugin(function ({ addVariant }) {
			addVariant('admin', '.admin-bar &');
		}),
	],
};
