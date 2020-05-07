const postcssImport = require('postcss-easy-import');
const tailwindcss = require('tailwindcss');
const postcssPresetEnv = require('postcss-preset-env');

const purgecssWordpress = require('purgecss-with-wordpress');
const purgecss = require('@fullhuman/postcss-purgecss')({
	// Specify the paths to all of the template files in your project
	content: ['./**/*.twig'],
	whitelist: purgecssWordpress.whitelist,
	whitelistPatterns: [
		/hidden|flex|inline-block|inline|block/,
		/bg-/,
		/text-/,
		/([mp])([tblryx])?-\d|auto/,
		...purgecssWordpress.whitelistPatterns,
	],

	// Include any special characters you're using in this regular expression
	defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
});

module.exports = {
	plugins: [
		postcssImport(),
		tailwindcss('src/tailwind.config.js'),
		postcssPresetEnv(),
		...(process.env.NODE_ENV === 'production' ? [purgecss] : []),
	],
};
