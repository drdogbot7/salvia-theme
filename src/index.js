import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';
import WebFont from 'webfontloader';

import './styles/main.css';

WebFont.load({
	google: {
		families: ['Roboto Slab:400,400i'],
	},
});

/** Load Events */
jQuery(function () {
	Alpine.plugin(collapse);
	Alpine.plugin(focus);
	Alpine.start();
	window.Alpine = Alpine;
});
