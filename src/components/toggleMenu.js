const toggleMenu = (el) => {
	el.classList.toggle('is-active');
	document.getElementById('mobile-menu').classList.toggle('is-active');
};

export default toggleMenu;
