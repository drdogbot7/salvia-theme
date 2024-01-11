import './styles/editor.css';

/**
 *  Add and Remove block styles
 */
wp.domReady(() => {
	wp.blocks.unregisterBlockStyle('core/separator', 'dots');
	wp.blocks.unregisterBlockStyle('core/separator', 'wide');
	wp.blocks.registerBlockStyle('core/button', {
		name: 'small',
		label: 'Small',
	});
	wp.blocks.registerBlockStyle('core/button', {
		name: 'large',
		label: 'Large',
	});
});
