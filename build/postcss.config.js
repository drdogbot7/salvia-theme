const postcssImport = require('postcss-import');
const tailwindcss = require('tailwindcss');
const postcssPresetEnv = require('postcss-preset-env');
const cssNano = require('cssnano');

module.exports = {
  plugins: [
    postcssImport(),
    tailwindcss('build/tailwind.config.js'),
    postcssPresetEnv({
      stage: 2
    }),
    cssNano({
      preset: 'default',
    }),
  ]
}