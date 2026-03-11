<?php
/**
 * PNG → WebP on upload (replace file).
 * JPG/JPEG → keep JPG, optimize it, and make WebP sidecars.
 */

/**
 * Helper: save a WebP copy if not exists.
 */
function my_save_webp(string $source, string $dest, int $quality = 90): bool {
  if (!file_exists($source)) return false;
  if (file_exists($dest))    return true;

  $img = wp_get_image_editor($source);
  if (is_wp_error($img)) return false;

  $img->set_quality($quality);
  $res = $img->save($dest, 'image/webp');

  return !is_wp_error($res) && file_exists($dest);
}

/**
 * 1) Upload-time transformation.
 * - PNG: convert to WebP (replace file, update mime/URL).
 * - JPG: re-save (optimize) in-place at chosen quality.
 */
add_filter('wp_handle_upload', function ($upload) {
  if (!isset($upload['file'], $upload['type'], $upload['url'])) {
    return $upload;
  }

  $file = $upload['file'];
  $type = $upload['type'];
  $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));

  // PNG → WebP (replace)
  if ($type === 'image/png' || $ext === 'png') {
    $editor = wp_get_image_editor($file);
    if (is_wp_error($editor)) {
      return $upload; // No editor support → leave as-is.
    }

    $dir  = dirname($file);
    $name = pathinfo($file, PATHINFO_FILENAME);
    $webp = $dir . '/' . $name . '.webp';

    // Preserve alpha; WebP supports transparency.
    $editor->set_quality(90);
    $saved = $editor->save($webp, 'image/webp');
    if (!is_wp_error($saved) && file_exists($webp)) {
      // @unlink($file); // remove original PNG

      // Make WordPress treat the upload as WebP
      $upload['file'] = $webp;
      $upload['type'] = 'image/webp';
      $upload['url']  = trailingslashit(dirname($upload['url'])) . $name . '.webp';
    }
    return $upload;
  }

  // JPG/JPEG → optimize in place (keep JPEG)
  if ($type === 'image/jpeg' || in_array($ext, ['jpg', 'jpeg'], true)) {
    $editor = wp_get_image_editor($file);
    if (is_wp_error($editor)) {
      return $upload;
    }
    // Choose your quality (70–85 is typical)
    $editor->set_quality(90);
    // Re-save as JPEG at the same path (optimize/compress)
    $saved = $editor->save($file, 'image/jpeg');
    // If it fails, just leave original as-is
    return $upload;
  }

  // Other types: unchanged
  return $upload;
}, 20);

/**
 * 2) After metadata is generated:
 *    If the base attachment is NOT WebP (i.e., JPEG case), create WebP sidecars
 *    for the original and all sub-sizes, and record them in metadata.
 */
add_filter('wp_generate_attachment_metadata', function ($metadata, $attachment_id) {
  $mime = get_post_mime_type($attachment_id);
  if (strpos((string) $mime, 'image/') !== 0) {
    return $metadata; // not an image
  }

  // If the base is already WebP (PNG→WebP path), do nothing: core will make WebP sizes.
  if ($mime === 'image/webp') {
    return $metadata;
  }

  // Create WebP sidecars for original + sizes (JPEG case).
  $uploads  = wp_upload_dir();
  $basedir  = rtrim($uploads['basedir'] ?? '', '/');
  $rel_file = $metadata['file'] ?? '';
  if (!$basedir || !$rel_file) return $metadata;

  $full_path = $basedir . '/' . $rel_file;
  $pinfo     = pathinfo($full_path);

  // Original → WebP
  $full_webp = $pinfo['dirname'] . '/' . $pinfo['filename'] . '.webp';
  if (my_save_webp($full_path, $full_webp, 90)) {
    // Record a virtual "full-webp" entry for convenience
    $metadata['sizes']['full-webp'] = [
      'file'      => $pinfo['filename'] . '.webp',
      'width'     => isset($metadata['width']) ? (int) $metadata['width'] : 0,
      'height'    => isset($metadata['height']) ? (int) $metadata['height'] : 0,
      'mime-type' => 'image/webp',
    ];
  }

  // Subsizes → WebP
  if (!empty($metadata['sizes']) && is_array($metadata['sizes'])) {
    $rel_dir = dirname($rel_file); // e.g. 2025/09
    foreach ($metadata['sizes'] as $size => $data) {
      if ($size === 'full-webp') continue; // skip our own entry
      if (empty($data['file'])) continue;

      $size_path = $basedir . '/' . $rel_dir . '/' . $data['file'];
      $si        = pathinfo($size_path);
      $size_webp = $si['dirname'] . '/' . $si['filename'] . '.webp';

      if (my_save_webp($size_path, $size_webp, 90)) {
        $metadata['sizes'][$size . '-webp'] = [
          'file'      => $si['filename'] . '.webp',
          'width'     => isset($data['width']) ? (int) $data['width'] : 0,
          'height'    => isset($data['height']) ? (int) $data['height'] : 0,
          'mime-type' => 'image/webp',
        ];
      }
    }
  }

  return $metadata;
}, 20, 2);
