const tailwindcss = require('tailwindcss');
const postcssPresetEnv = require('postcss-preset-env');

module.exports = {
	plugins: [
		tailwindcss('src/tailwind.config.js'),
		postcssPresetEnv({ stage: 0 }),
	],
};
