import './styles/editor.scss';

/**
 *  Remove some block style
 */
wp.domReady(() => {
	wp.blocks.unregisterBlockStyle('core/separator', 'dots');
	wp.blocks.unregisterBlockStyle('core/separator', 'wide');
});
