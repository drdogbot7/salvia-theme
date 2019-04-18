"use strict";

const webpack = require("webpack");
const WebpackAssetsManifest = require("webpack-assets-manifest");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CleanWebpackPlugin = require("clean-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const FriendlyErrorsPlugin = require("friendly-errors-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const path = require("path");
const fs = require("fs");

const ImageminPlugin = require("imagemin-webpack");
const imageminGifsicle = require("imagemin-gifsicle");
const imageminJpegtran = require("imagemin-jpegtran");
const imageminOptipng = require("imagemin-optipng");
const imageminSvgo = require("imagemin-svgo");

// Make sure any symlinks in the project folder are resolved:
// https://github.com/facebookincubator/create-react-app/issues/637
const appDirectory = fs.realpathSync(process.cwd());

function resolveApp(relativePath) {
  return path.resolve(appDirectory, relativePath);
}

const paths = {
  appSrc: resolveApp("src"),
  appBuild: resolveApp("dist"),
  appIndexJs: resolveApp("src/index.js"),
  appNodeModules: resolveApp("node_modules")
};

const DEV = process.env.NODE_ENV === "development";

module.exports = {
  stats: "minimal",
  bail: !DEV,
  mode: DEV ? "development" : "production",
  // We generate sourcemaps in production. This is slow but gives good results.
  // You can exclude the *.map files from the build during deployment.
  target: "web",
  devtool: DEV ? "cheap-eval-source-map" : "source-map",
  entry: [paths.appIndexJs],
  output: {
    path: paths.appBuild,
    filename: DEV ? "bundle.js" : "bundle.[hash:8].js"
  },
  module: {
    rules: [
      // Disable require.ensure as it's not a standard language feature.
      { parser: { requireEnsure: false } },
      // Transform ES6 with Babel
      {
        test: /\.js?$/,
        loader: "babel-loader",
        include: paths.appSrc
      },
      {
        test: /.(scss|css)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader"
          },
          {
            loader: "postcss-loader",
            options: {
              ident: "postcss", // https://webpack.js.org/guides/migrating/#complex-options
              config: {
                path: 'build/'
              }
            }
          },
          "sass-loader"
        ]
      },
      {
        test: /\.(svg|png|jpeg|jpg|gif)$/i,
        use: [
          {
            loader: "file-loader"
          }
        ]
      }
    ]
  },
  optimization: {
    minimize: !DEV,
    minimizer: [
      new OptimizeCSSAssetsPlugin({
        cssProcessorOptions: {
          map: {
            inline: false,
            annotation: true
          }
        }
      }),
      new TerserPlugin({
        terserOptions: {
          compress: {
            warnings: false
          },
          output: {
            comments: false
          }
        },
        sourceMap: true
      })
    ]
  },
  plugins: [
    !DEV && new CleanWebpackPlugin({
      verbose: true
    }),
    new MiniCssExtractPlugin({
      filename: DEV ? "bundle.css" : "bundle.[hash:8].css"
    }),
    new webpack.EnvironmentPlugin({
      NODE_ENV: "development", // use 'development' unless process.env.NODE_ENV is defined
      DEBUG: false
    }),
    new WebpackAssetsManifest({
      output: "assets.json"
    }),
    DEV && new FriendlyErrorsPlugin({
      clearConsole: false
    }),
    DEV && new BrowserSyncPlugin({
      notify: false,
      host: "localhost",
      port: 3000,
      logLevel: "silent",
      files: ["./*.(php|twig)"],
      proxy: "http://localhost:5318/"
    }), 
  ].filter(Boolean)
};