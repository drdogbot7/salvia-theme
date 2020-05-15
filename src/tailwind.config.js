const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
	prefix: '',
	important: false,
	separator: ':',
	theme: {
		extend: {
			colors: {
				tint: {
					10: '#FFFFFF19',
					25: '#FFFFFF44',
					50: '#FFFFFF88',
					75: '#FFFFFFCC',
					90: '#FFFFFFE6',
				},
				shade: {
					10: '#00000019',
					25: '#00000044',
					50: '#00000088',
					75: '#000000CC',
					90: '#000000E6',
				},
			},
		},
	},
	variants: {},
	corePlugins: {},
	plugins: [require('@tailwindcss/custom-forms')],
	purge: {
		content: ['./views/**/*.twig'],
	},
};
