import jQuery from 'jquery';
import toggleMenu from './components/toggleMenu';
import { addBackToTop } from 'vanilla-back-to-top';

import './styles/main.css';

const initPage = () => {
	document.getElementById('hamburger').addEventListener('click', function () {
		toggleMenu(this);
	});
	addBackToTop({ backgroundColor: '#008FD5' });
};

/** Load Events */
jQuery(document).ready(() => initPage());
