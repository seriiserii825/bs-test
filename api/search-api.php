<?php
if (!defined('ABSPATH')) exit;

/** 1) Единый источник правды — функция со схемой (draft-07) */
function page_search_json_schema(): array
{
  return [
    '$schema' => 'http://json-schema.org/draft-07/schema#',
    'title'   => 'SearchApi',
    'type'    => 'object',
    'additionalProperties' => false,
    'properties' => [
      'pages' => [
        'type'  => 'array',
        'items' => [
          'type'                 => 'object',
          'additionalProperties' => false,
          'properties' => [
            'id'    => ['type' => 'number'], // или 'integer', если гарантированно без дробей
            'title' => ['type' => 'string'],
            'url'   => ['type' => 'string', 'format' => 'uri'],
            'img'   => ['type' => ['string', 'null'], 'format' => 'uri'], // у тебя было boolean — тут корректнее string|null
            'slug'  => ['type' => 'string'],
          ],
          'required' => ['id', 'title', 'url', 'img', 'slug'],
        ],
      ],
    ],
    'required' => ['pages'],
  ];
}

/** 2) Основной GET-эндпоинт с данными */
function page_register_search()
{
  register_rest_route('page/v1', '/search', [
    'methods'             => WP_REST_SERVER::READABLE,
    'permission_callback' => '__return_true',
    'args' => [
      'title' => [
        'description' => 'Search keyword for page title.',
        'type'        => 'string',
        'required'    => true,
      ],
    ],
    'callback' => 'pageSearchResults',
  ]);

  /** 3) Отдельный эндпоинт для схемы */
  register_rest_route('page/v1', '/search/schema', [
    'methods'             => WP_REST_SERVER::READABLE,
    'permission_callback' => '__return_true',
    'callback'            => function () {
      return page_search_json_schema();
    },
  ]);
}
add_action('rest_api_init', 'page_register_search');

/** Данные */
function pageSearchResults(WP_REST_Request $request)
{
  $title = sanitize_text_field($request['title']);
  $page_result = [];

  $q = new WP_Query([
    'post_type'      => 'page',
    'posts_per_page' => -1,
    's'              => $title,
  ]);

  while ($q->have_posts()) {
    $q->the_post();
    $page_result[] = [
      'id'    => get_the_ID(),
      'title' => html_entity_decode(get_the_title()),
      'url'   => get_the_permalink(),
      'img'   => get_the_post_thumbnail_url(get_the_ID(), 'full') ?: null,
      'slug'  => basename(get_permalink(get_the_ID())),
    ];
  }
  wp_reset_postdata();

  return ['pages' => $page_result];
}
