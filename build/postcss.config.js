const postcssImport = require("postcss-import");
const tailwindcss = require("tailwindcss");
const postcssPresetEnv = require("postcss-preset-env");

module.exports = {
  plugins: [
    postcssImport(),
    tailwindcss("src/styles/tailwind.config.js"),
    postcssPresetEnv({
      stage: 2
    })
  ]
};
