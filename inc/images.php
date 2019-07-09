<?php
/*
Custom Image Sizes
Uncomment as needed.
*/

// 3:1
// add_image_size('3-to-1_1140w', 1140, 380, true);
// add_image_size('3-to-1_1110w', 1110, 370, true );
// add_image_size('3-to-1_960w', 960, 320, true);
// add_image_size('3-to-1_720w', 720, 240, true);
// add_image_size('3-to-1_640w', 640, 213, true);
// add_image_size('3-to-1_480w', 480, 160, true);
// add_image_size('3-to-1_240w', 240, 80, true );

// 2:1
// add_image_size('2-to-1_1140w', 1140, 570, true);
// add_image_size('2-to-1_1110w', 1110, 555, true );
// add_image_size('2-to-1_960w', 960, 480, true);
// add_image_size('2-to-1_720w', 720, 360, true);
// add_image_size('2-to-1_640w', 640, 320, true);
// add_image_size('2-to-1_480w', 480, 240, true);
// add_image_size('2-to-1_240w', 240, 120, true );

// 16:9
// add_image_size('16-to-9_1140w', 1140, 641, true );
// add_image_size('16-to-9_1110w', 1110, 625, true );
// add_image_size('16-to-9_960w', 960, 540, true );
// add_image_size('16-to-9_720w', 720, 405, true );
// add_image_size('16-to-9_640w', 640, 360, true );
// add_image_size('16-to-9_480w', 480, 270, true );
// add_image_size('16-to-9_240w', 240, 135, true );

// 3:2
// add_image_size('3-to-2_1140w', 1140, 760, true );
// add_image_size('3-to-2_1110w', 1110, 740, true );
// add_image_size('3-to-2_960w', 960, 640, true );
// add_image_size('3-to-2_720w', 720, 480, true );
// add_image_size('3-to-2_640w', 640, 427, true );
// add_image_size('3-to-2_540w', 540, 360, true );
// add_image_size('3-to-2_480w', 480, 320, true );
// add_image_size('3-to-2_240w', 240, 160, true );

// 4:3
// add_image_size('4-to-3_1140w', 1140, 855, true );
// add_image_size('4-to-3_1110w', 1110, 833, true );
// add_image_size('4-to-3_960w', 960, 720, true );
// add_image_size('4-to-3_720w', 720, 540, true );
// add_image_size('4-to-3_640w', 640, 480, true );
// add_image_size('4-to-3_480w', 480, 360, true );
// add_image_size('4-to-3_240w', 240, 180, true );

// 5:4
// add_image_size('5-to-4_1140w', 1140, 912, true );
// add_image_size('5-to-4_1110w', 1110, 888, true );
// add_image_size('5-to-4_960w', 960, 768, true );
// add_image_size('5-to-4_720w', 720, 576, true );
// add_image_size('5-to-4_640w', 640, 512, true );
// add_image_size('5-to-4_540w', 540, 432, true );
// add_image_size('5-to-4_480w', 480, 384, true );
// add_image_size('5-to-4_240w', 240, 192, true );

// Square
// add_image_size('1-to-1_640w', 640, 640, true);
// add_image_size('1-to-1_480w', 480, 480, true);
// add_image_size('1-to-1_360w', 360, 360, true );
// add_image_size('1-to-1_240w', 240, 240, true );

// Add Custom Image Sizes to Image Selector
// add_filter('image_size_names_choose', __NAMESPACE__ . '\\my_image_sizes');

function my_image_sizes($sizes)
{
    $addsizes = array(
    // "16-to-9_640w" => __( "16:9 cropped"),
    // "4-to-3_640w" => __( "4:3 cropped")
  );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}
