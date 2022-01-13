import './styles/editor.scss';

/**
 *  Add class names to core blocks that normally don't have them
 */

const setExtraPropsToBlockType = (props, blockType, attributes) => {
	const notDefined =
		typeof props.className === 'undefined' || !props.className ? true : false;

	if (blockType.name === 'core/heading') {
		return Object.assign(props, {
			className: notDefined
				? `wp-block-heading wp-block-heading--h${attributes.level}`
				: `wp-block-heading wp-block-heading--h${attributes.level} ${props.className}`,
		});
	}

	if (blockType.name === 'core/list') {
		console.table(attributes);
		return Object.assign(props, {
			className: notDefined
				? `wp-block-list wp-block-list--${
						attributes.ordered ? 'ordered' : 'unordered'
				  }`
				: `wp-block-list wp-block-list--${
						attributes.ordered ? 'ordered' : 'unordered'
				  } ${props.className}`,
		});
	}

	if (blockType.name === 'core/paragraph') {
		return Object.assign(props, {
			className: notDefined
				? 'wp-block-paragraph'
				: `wp-block-paragraph ${props.className}`,
		});
	}

	return props;
};

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'salvia/block-filters',
	setExtraPropsToBlockType
);

/**
 *  Remove some block variations
 */
wp.domReady(() => {
	wp.blocks.unregisterBlockStyle('core/button', 'default');
	// wp.blocks.unregisterBlockStyle('core/button', 'outline');
	// wp.blocks.unregisterBlockStyle('core/button', 'squared');
});
