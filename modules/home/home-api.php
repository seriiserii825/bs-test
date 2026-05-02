<?php
if (!defined('ABSPATH')) exit;

function homeApi()
{
  register_rest_route('site/v1', '/home', [
    'methods'             => WP_REST_SERVER::READABLE,
    'permission_callback' => '__return_true',
    'callback' => 'homeApiCallBack',
  ]);
}
add_action('rest_api_init', 'homeApi');

function homeApiCallBack()
{
  $page_home_id = 2;
  $home_intro = get_field('home_intro', $page_home_id);
  $about = get_field('about', $page_home_id);
  $banner = get_field('banner', $page_home_id);
  $brand = get_field('brand', $page_home_id);
  $response = [
    'home_intro' => $home_intro,
    'about' => $about,
    'banner' => $banner,
    'brand' => $brand,
  ];
  return rest_ensure_response($response);
}
