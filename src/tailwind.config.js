const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('./tailwind.colors');
const gutenberg = require('tailwindcss-gutenberg');

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
			colors: {
				tint: colors.tint,
				shade: colors.shade,
			},
		},
	},
	variants: {},
	corePlugins: {},
	plugins: [require('@tailwindcss/forms')],
};
