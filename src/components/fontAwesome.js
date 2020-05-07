import { library, dom } from '@fortawesome/fontawesome-svg-core';

import {
	faTwitter,
	faFacebook,
	faLinkedin,
	faInstagram,
	faYoutube,
} from '@fortawesome/free-brands-svg-icons';

import { faHeart } from '@fortawesome/pro-solid-svg-icons';

const initFontAwesome = () => {
	library.add(faTwitter, faFacebook, faLinkedin, faInstagram, faYoutube);
	library.add(faHeart);
	dom.watch();
};

export default initFontAwesome;
