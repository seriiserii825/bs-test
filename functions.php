<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
  exit;

$vite_dev = true;

$footer_page_id = 775;
define('IS_VITE_DEVELOPMENT', $vite_dev);

include "inc/inc.vite.php";
// include_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/vue/vue-functions.php';

require_once __DIR__ . '/api/search-api.php';

// require_once __DIR__ . '/Api/call-api.php';
// require_once __DIR__ . '/Api/single-immobile-meta.php';
// require_once __DIR__ . '/inc/Custom_Walker_Nav_Menu.php';
require_once __DIR__ . '/inc/image_front.php';
require_once __DIR__ . '/inc/image_sizes_on_upload.php';
require_once __DIR__ . '/inc/image_to_jpg_webp.php';
// require_once __DIR__ . '/inc/class-tgm-plugin-activation.php';
// require_once __DIR__ . '/inc/tgm_example.php';
require_once __DIR__ . '/inc/urls-add-rewrite-rules.php';
require_once __DIR__ . '/inc/ar-setup.php';
require_once __DIR__ . '/inc/acf.php';
require_once __DIR__ . '/inc/func.php';
require_once __DIR__ . '/inc/ar-widgets.php';
require_once __DIR__ . '/inc/theme-scripts.php';
require_once __DIR__ . '/inc/project-variables.php';
require_once __DIR__ . '/shortcodes/short_company_name.php';
require_once __DIR__ . '/shortcodes/full_company_name.php';
require_once __DIR__ . '/shortcodes/full_address.php';
require_once __DIR__ . '/shortcodes/vat.php';
require_once __DIR__ . '/shortcodes/phone_number.php';
require_once __DIR__ . '/shortcodes/email.php';
/* require_once __DIR__ . '/inc/ar-post-type.php'; */
/* require_once __DIR__ . '/inc/ar-taxonomy.php'; */
/* require_once __DIR__ . '/inc/activate-plugin.php'; */

add_filter('acfwpcli_fieldgroup_paths', 'add_plugin_path');
function add_plugin_path($paths)
{
  $paths['my_plugin'] = get_template_directory() . '/acf/';
  return $paths;
}

add_action('admin_enqueue_scripts', function () {
  $css = get_stylesheet_directory_uri() . '/admin-styles.css';
  wp_enqueue_style('theme-admin', $css, [], null);
});

// add_action('enqueue_block_editor_assets', function () {
//   $theme_style_url = get_stylesheet_directory_uri() . '/dist/css/admin-style.css';
//   wp_enqueue_style('theme-admin', $theme_style_url, [], null);
//   $gutenberg_styles = get_stylesheet_directory_uri() . '/guttenberg-styles.css';
//   wp_enqueue_style('theme-gutenberg', $gutenberg_styles, [], null);
// });
