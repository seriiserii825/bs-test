<?php
if (!defined('ABSPATH')) {
  exit;
}


function clear_phone($phone, $excluded_chars = [])
{
  if ($excluded_chars) {
    foreach ($excluded_chars as $char) {
      $phone = str_replace($char, '', $phone);
    }
  }
  return preg_replace("/[^0-9+]/", "", $phone);
}
function vardump($var)
{
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}
add_filter('big_image_size_threshold', '__return_zero');
function get_lang()
{
  $suffix = '';
  if (get_locale() == 'en_US') {
    $suffix = '_en';
  }
  if (get_locale() == 'ru_RU') {
    $suffix = '_ru';
  }
  if (get_locale() == 'ro_RO') {
    $suffix = '_ro';
  }
  if (get_locale() == 'it_IT') {
    $suffix = '_it';
  }
  if (get_locale() == 'de_DE') {
    $suffix = '_de';
  }
  return strtolower($suffix);
}
function my_revisions_to_keep($revisions)
{
  return 3;
}
add_filter('wp_revisions_to_keep', 'my_revisions_to_keep');
function wpassist_remove_block_library_css()
{
  wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'wpassist_remove_block_library_css');
add_filter('intermediate_image_sizes_advanced', 'true_remove_default_sizes');
function true_remove_default_sizes($sizes)
{
  unset($sizes['medium']);
  unset($sizes['large']);
  return $sizes;
}
function remove_pages_editor()
{
  $ids = [8];
  if (in_array(get_the_ID(), $ids)) {
    remove_post_type_support('page', 'editor');
  } // end if
} // end remove_pages_editor
add_action('add_meta_boxes', 'remove_pages_editor');
add_filter('wpcf7_autop_or_not', '__return_false');


if (!function_exists('write_log')) {

  function write_log($log)
  {
    if (true === WP_DEBUG) {
      if (is_array($log) || is_object($log)) {
        error_log(print_r($log, true));
      } else {
        error_log($log);
      }
    }
  }
}


function parse_globus_content($content)
{
  $locale_map = [
    'it_IT' => 'it',
    'en_US' => 'en',
    'ru_RU' => 'ru',
    'ro_RO' => 'ro',
    'de_DE' => 'de',
  ];

  $lang = $locale_map[get_locale()] ?? 'it';

  preg_match_all('/\{:([a-z]+)\}(.*?)\{:\}/s', $content, $matches, PREG_SET_ORDER);

  if (empty($matches)) {
    return $content;
  }

  foreach ($matches as $match) {
    if ($match[1] === $lang) {
      return trim($match[2]);
    }
  }

  // Fallback to Italian
  foreach ($matches as $match) {
    if ($match[1] === 'it') {
      return trim($match[2]);
    }
  }

  return trim($matches[0][2]);
}
