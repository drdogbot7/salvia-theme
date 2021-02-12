<?php

function block_editor_features( $base_font_size = 16 ) {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => 'Primary',
            'slug' => 'primary',
            'color' => '#3B82F6',
        ),
        array(
            'name' => 'Loud',
            'slug' => 'loud',
            'color' => '#EF4444',
        ),
        array(
            'name' => 'Secondary',
            'slug' => 'secondary',
            'color' => '#8B5CF6',
        ),
        array(
            'name' => 'Light',
            'slug' => 'light',
            'color' => '#edf2f7',
        ),
        array(
            'name' => 'Dark',
            'slug' => 'dark',
            'color' => '#2d3748',
        ),
    ) );
    add_theme_support( 'editor-font-sizes', array(
        ['name' => 'Small', 'size' => 12, 'slug'=>'small'],
        ['name' => 'Normal', 'size' => 16, 'slug'=>'normal'],
        ['name' => 'Medium', 'size' => 18, 'slug'=>'medium'],
        ['name' => 'Large', 'size' => 24, 'slug'=>'large'],
        ['name' => 'Huge', 'size' => 36, 'slug'=>'huge']
    ) );
    add_theme_support( 'align-wide' );
}
 
add_action( 'after_setup_theme', 'block_editor_features' );