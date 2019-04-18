<?php

/**
 * Get paths for assets
 */
class JsonManifest
{
    private $manifest;
    public function __construct($manifest_path)
    {
        if (file_exists($manifest_path)) {
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $this->manifest = [];
        }
    }
    public function get()
    {
        return $this->manifest;
    }
    public function getPath($key = '', $default = null)
    {
        $collection = $this->manifest;
        if (is_null($key)) {
            return $collection;
        }
        if (isset($collection[$key])) {
            return $collection[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if (!isset($collection[$segment])) {
                return $default;
            } else {
                $collection = $collection[$segment];
            }
        }
        return $collection;
    }
}
function salvia_asset($filename)
{
    $dist_path = get_stylesheet_directory_uri() . '/dist/';
    static $manifest;
    if (empty($manifest)) {
        $manifest_path = get_stylesheet_directory() . '/dist/' . 'assets.json';
        $manifest = new JsonManifest($manifest_path);
    }
    if (is_child_theme()) {
        $parent_dist_path = get_template_directory_uri() . '/dist/';
        static $parent_manifest;
  
        if (empty($parent_manifest)) {
            $parent_manifest_path = get_template_directory() . '/dist/' . 'assets.json';
            $parent_manifest = new JsonManifest($parent_manifest_path);
        }
    }
  
    if (array_key_exists($filename, $manifest->get())) {
        return $dist_path . $manifest->get()[$filename];
    } elseif (is_child_theme() && array_key_exists($filename, $parent_manifest->get())) {
        return $parent_dist_path . $parent_manifest->get()[$filename];
    }
   
    return $dist_path . $filename;
}