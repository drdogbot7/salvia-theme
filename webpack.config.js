const Encore = require('@symfony/webpack-encore');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
// if (!Encore.isRuntimeEnvironmentConfigured()) {
//   Encore.configureRuntimeEnvironment(process.env.NODE_ENV || "dev");
// }

// Set NODE_ENV to production or dev, used in postcss.config.js
// https://github.com/symfony/webpack-encore/issues/610
process.env.NODE_ENV = Encore.isProduction() ? 'production' : 'development';

Encore
	// directory where compiled assets will be stored
	.setOutputPath('./dist')
	// public path used by the web server to access the output path
	.setPublicPath('/wp-content/themes/salvia-theme/dist/')
	// only needed for CDN's or sub-directory deploy
	.setManifestKeyPrefix('')

	/*
	 * ENTRY CONFIG
	 */
	.addEntry('app', './src/index.js')
	.addEntry('images', './src/images/index.js')

	// When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
	.splitEntryChunks()

	// will require an extra script tag for runtime.js
	// but, you probably want this, unless you're building a single-page app
	.enableSingleRuntimeChunk()
	// .disableSingleRuntimeChunk()

	.addExternals({
		jquery: 'jQuery',
	})

	/*
	 * FEATURE CONFIG
	 *
	 * Enable & configure other features below. For a full
	 * list of features, see:
	 * https://symfony.com/doc/current/frontend.html#adding-more-features
	 */
	.cleanupOutputBeforeBuild()
	// .enableBuildNotifications()
	.enableSourceMaps(!Encore.isProduction())
	// enables hashed filenames (e.g. app.abc123.css)
	.enableVersioning(Encore.isProduction())
	// enables @babel/preset-env polyfills
	.configureBabelPresetEnv((config) => {
		config.useBuiltIns = 'usage';
		config.corejs = 3;
	})
	// enable sass
	.enableSassLoader()

	// enables postcss
	.enablePostCssLoader()

	.addPlugin(
		new BrowserSyncPlugin({
			notify: false,
			host: 'localhost',
			port: 3000,
			logLevel: 'default',
			files: ['**/*.(php|twig)'],
			proxy: 'http://localhost:8080',
		})
	);

// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()

module.exports = Encore.getWebpackConfig();
