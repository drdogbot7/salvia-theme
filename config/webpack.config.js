// webpack.config.js

const webpack = require("webpack");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const CleanWebpackPlugin = require("clean-webpack-plugin");
const ImageminPlugin = require("imagemin-webpack-plugin").default;
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const path = require("path");
const WebpackAssetsManifest = require("webpack-assets-manifest");

const themeOpts = require("./theme.config.json");

module.exports = (env, argv) => {
  let config = {
    entry: {
      main: "./assets/scripts/main.js",
      customizer: "./assets/scripts/customizer.js",
      images: "./assets/images/",
      style: "./assets/styles/main.scss"
    },
    output: {
      path: path.resolve(__dirname, "dist"),
      filename: "[name]-[hash].js",
      publicPath: "/wp-content/themes/" + themeOpts.name + "/dist/"
    },
    externals: {
      jquery: "jQuery"
    },
    devtool: "source-map",
    module: {
      rules: [
        {
          test: /\.scss$/,
          include: path.resolve(__dirname, "assets"),
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
              options: {
                // you can specify a publicPath here
                // by default it use publicPath in webpackOptions.output
                publicPath: "../"
              }
            },
            {
              loader: "css-loader",
              options: {
                sourceMap: argv.mode === "development"
              }
            },
            {
              loader: "postcss-loader",
              options: {
                sourceMap: argv.mode === "development",
                config: {
                  path: "./postcss.config.js"
                }
              }
            },
            {
              loader: "sass-loader",
              options: {
                sourceMap: argv.mode === "development"
              }
            },
            {
              loader: "import-glob"
            }
          ]
        },
        {
          test: /\.(png|jpg|jpeg|gif|svg|woff2|woff|eot|ttf)$/,
          use: {
            loader: "file-loader",
            options: {
              name: "[name]-[hash].[ext]"
            }
          }
        },
        {
          test: /\.js$/,
          include: path.resolve(__dirname, "assets/scripts/"),
          use: [
            {
              loader: "babel-loader",
              options: {
                presets: [["env"]]
              }
            }
          ]
        }
      ]
    },
    plugins: [
      new BrowserSyncPlugin({
        host: "localhost",
        port: 3000,
        proxy: themeOpts.proxy,
        files: [
          {
            match: [
              path.resolve(__dirname, "**/*.php"),
              path.resolve(__dirname, "**/*.twig")
            ]
          }
        ]
      }),
      new CleanWebpackPlugin("dist"),
      new MiniCssExtractPlugin({
        // Options similar to the same options in webpackOptions.output
        // both options are optional
        filename: "[name]-[contenthash].css"
      }),
      new ImageminPlugin({
        test: "/.(jpe?g|png|gif|svg)$/i",
        disable: argv.mode === "development"
      }),
      new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
        "window.jQuery": "jquery"
      }),
      new WebpackAssetsManifest({
        output: "assets.json"
      })
    ]
  };

  return config;
};
