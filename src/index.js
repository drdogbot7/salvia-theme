import alpine from 'alpinejs';
import WebFont from 'webfontloader';
import { addBackToTop } from 'vanilla-back-to-top';
import tailwind from './tailwind.config.js';
import initFontAwesome from './components/fontAwesome';

import './styles/main.scss';

WebFont.load({
	google: {
		families: ['Raleway:200,400'],
	},
});

/** Load Events */
jQuery(function () {
	initFontAwesome();
	addBackToTop({ backgroundColor: tailwind.gutenberg.colors.primary });
});
