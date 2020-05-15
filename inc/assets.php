<?php
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

function salvia_asset($file)
{
    $package = new Package(
        new JsonManifestVersionStrategy(get_stylesheet_directory() . '/dist/manifest.json')
    );
    return $package->getUrl($file);
}