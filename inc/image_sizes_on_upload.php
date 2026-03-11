<?php

add_filter('wp_handle_upload', 'resize_large_uploaded_images');

function resize_large_uploaded_images($upload)
{
  // Only run on images
  $filetype = wp_check_filetype($upload['file']);
  if (strpos($filetype['type'], 'image') === false) {
    return $upload;
  }

  // Load the image editor
  $editor = wp_get_image_editor($upload['file']);
  if (is_wp_error($editor)) {
    return $upload; // Couldn’t load editor
  }

  $size = $editor->get_size();
  $width  = $size['width'];
  $height = $size['height'];

  // If width is more than 1920, resize proportionally
  if ($width > 1920) {
    $editor->resize(1920, null); // null keeps aspect ratio
    $editor->save($upload['file']);
  } 
  // elseif ($height > 1080) {
  //   $editor->resize(null, 1080); // null keeps aspect ratio
  //   $editor->save($upload['file']);
  // }

  return $upload;
}
