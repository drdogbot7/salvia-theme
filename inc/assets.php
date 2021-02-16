<?php
use function BenTools\WebpackEncoreResolver\asset;

function salvia_asset($file)
{
	return asset($file, get_stylesheet_directory() . '/dist');
}
