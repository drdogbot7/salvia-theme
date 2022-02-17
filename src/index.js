import Alpine from 'alpinejs';
import WebFont from 'webfontloader';
import { addBackToTop } from 'vanilla-back-to-top';
import initFontAwesome from './components/fontAwesome';

import './styles/main.scss';

WebFont.load({
	google: {
		families: ['Roboto Slab:400,400i'],
	},
});

/** Load Events */
jQuery(function () {
	initFontAwesome();
	addBackToTop({ backgroundColor: 'black' });
	window.Alpine = Alpine;
	Alpine.start();
});
