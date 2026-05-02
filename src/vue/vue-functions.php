<?php
// MAIN FILTER ADDS

// add_shortcode('vue-search', 'my_shortcode_cost_vue_search');

// function my_shortcode_cost_vue_search($atts, $content = null)
// {
//   $site_url = get_site_url();

//   return "<div id='vueSearch'>
//   <main-search site-url='{$site_url}' />
//   </div>";
// }


add_shortcode('vue-home', 'vueHome');

function vueHome()
{
  return "<div id='vueHome'></div>";
}

add_shortcode('vue-search', 'vueSearch');

function vueSearch()
{
  return "<div id='vueSearch'></div>";
}
