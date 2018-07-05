// webpack.config.js

const webpack = require('webpack')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const ImageminPlugin = require('imagemin-webpack-plugin').default
const path = require('path')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const WebpackAssetsManifest = require('webpack-assets-manifest')

const themeOpts = require('./webpack/theme.config.json')

module.exports = (env = {}) => {
  const isProduction = env.production === true
  const isDevelopment = env.production !== true

  let config = {
    entry: {
      main: './assets/scripts/main.js',
      customizer: './assets/scripts/customizer.js',
      images: './assets/images/images.js',
      style: './assets/styles/main.scss'
    },
    output: {
      path: path.resolve(__dirname, 'dist'),
      filename: isProduction ? '[name]-[hash].js' : '[name].js',
      publicPath: '/wp-content/themes/' + themeOpts.name + '/dist/'
    },
    externals: {
      jquery: 'jQuery'
    },
    devtool: 'source-map',
    module: {
      rules: [
        {
          test: /\.scss$/,
          include: path.resolve(__dirname, 'assets'),
          use: ExtractTextPlugin.extract({
            use: [
              {
                loader: 'css-loader',
                options: {
                  sourceMap: isDevelopment
                }
              },
              {
                loader: 'postcss-loader',
                options: {
                  sourceMap: isDevelopment,
                  config: {
                    path: 'webpack/postcss.config.js'
                  }
                }
              },
              {
                loader: 'sass-loader',
                options: {
                  sourceMap: isDevelopment
                }
              },
              {
                loader: 'import-glob'
              }
            ]
          })
        },
        {
          test: /\.(png|jpg|jpeg|gif|svg|woff2|woff|eot|ttf)$/,
          use: {
            loader: 'file-loader',
            options: {
              name: isProduction ? '[name]-[hash].[ext]' : '[name].[ext]'
            }
          }
        },
        {
          test: /\.js$/,
          include: path.resolve(__dirname, 'assets/scripts/'),
          use: [
            {
              loader: 'babel-loader',
              options: {
                presets: [['env']]
              }
            }
          ]
        }
      ]
    },
    plugins: [
      new BrowserSyncPlugin({
        host: 'localhost',
        port: 3000,
        proxy: themeOpts.proxy,
        files: [
          {
            match: [
              path.resolve(__dirname, '**/*.php'),
              path.resolve(__dirname, '**/*.twig')
            ]
          }
        ]
      }),
      new CleanWebpackPlugin(isProduction ? 'dist' : ''),
      new ExtractTextPlugin({
        filename: isProduction ? '[name]-[contenthash].css' : '[name].css'
      }),
      new ImageminPlugin({
        test: '/.(jpe?g|png|gif|svg)$/i',
        disable: isDevelopment
      }),
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
        Popper: ['popper.js', 'default']
      }),
      new UglifyJsPlugin({
        test: /\.js($|\?)/i
      }),
      new WebpackAssetsManifest({
        output: 'assets.json'
      })
    ]
  }

  return config
}
