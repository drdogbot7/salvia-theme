module.exports = {
  parser: 'postcss-safe-parser',
  plugins: {
    'postcss-import': {},
    tailwindcss: 'assets/styles/tailwind.js',
    'postcss-preset-env': {
      stage: 2
    },
    cssnano: {}
  }
}
