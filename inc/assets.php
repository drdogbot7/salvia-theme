<?php
/**
 * Asset function for referencing theme assets
 * reads webpack asset manifest
 * 
 * @package Wordpress
 * @subpackage Timber
 * @since Salvia 1.0.0
 */

use function BenTools\WebpackEncoreResolver\asset;

function salvia_asset($file)
{
	return asset($file, get_stylesheet_directory() . '/dist');
}