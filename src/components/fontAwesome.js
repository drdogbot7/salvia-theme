import { library, dom } from '@fortawesome/fontawesome-svg-core';

import {
	faTwitter,
	faFacebook,
	faLinkedin,
	faInstagram,
	faYoutube,
} from '@fortawesome/free-brands-svg-icons';

import {
	faBars,
	faTimes,
	faCaretDown,
} from '@fortawesome/free-solid-svg-icons';

const initFontAwesome = () => {
	library.add(faTwitter, faFacebook, faLinkedin, faInstagram, faYoutube);
	library.add(faBars, faTimes, faCaretDown);
	dom.watch();
};

export default initFontAwesome;
