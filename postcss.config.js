const postcssImport = require('postcss-easy-import');
const tailwindcss = require('tailwindcss');
const postcssPresetEnv = require('postcss-preset-env');
const postcssExtend = require('postcss-extend');

module.exports = {
	plugins: [
		postcssImport(),
		tailwindcss('src/tailwind.config.js'),
		postcssExtend(),
		postcssPresetEnv({ stage: 0 }),
	],
};
