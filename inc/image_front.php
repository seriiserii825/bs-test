<?php

/**
 * Normalize any ACF image return (ID, array, or URL) to attachment ID.
 *
 * @param mixed $image
 * @return int|null Attachment ID or null if not found
 */
function my_get_image_id($image)
{
  if (empty($image)) {
    return null;
  }

  // Case 1: already an ID
  if (is_numeric($image)) {
    return (int) $image;
  }

  // Case 2: array with ID key
  if (is_array($image) && !empty($image['ID'])) {
    return (int) $image['ID'];
  }

  // Case 3: URL
  if (is_string($image) && filter_var($image, FILTER_VALIDATE_URL)) {
    $id = attachment_url_to_postid($image);
    return $id ? (int) $id : null;
  }

  return null;
}

function create_picture($id, $size = 'full', $lazy = false)
{
  $jpg_url  = wp_get_attachment_image_url($id, $size);
  $webp_url = wp_get_attachment_image_url($id, $size . '-webp');
  $alt      = get_post_meta($id, '_wp_attachment_image_alt', true);

  // fallback alt → title if empty
  if (empty($alt)) {
    $alt = get_the_title($id);
  }

  if ($lazy) {
    $lazy_attr = ' loading="lazy"';
  } else {
    $lazy_attr = '';
  }

  echo '<picture>';
  if ($webp_url) {
    echo '<source srcset="' . esc_url($webp_url) . '" type="image/webp">';
  }
  echo '<img src="' . esc_url($jpg_url) . '" alt="' . esc_attr($alt) . '" ' . $lazy_attr . '/>';
  echo '</picture>';
}
