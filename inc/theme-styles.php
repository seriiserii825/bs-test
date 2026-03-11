<?php 

	// wp_enqueue_style('bs_vite-lightgallery-css', get_template_directory_uri() . '/assets/libs/lightgallery.js/dist/css/lightgallery.min.css');
	// wp_enqueue_style('bs_vite-magnific-css', get_template_directory_uri() . '/assets/libs/magnific-popup/magnific-popup.css');
	wp_enqueue_style('bs_vite-slick-css', get_template_directory_uri() . '/assets/libs/slick/slick.css');
	wp_enqueue_style('bs_vite-leaflet-css', get_template_directory_uri() . '/assets/libs/leaflet/leaflet.css');
	// wp_enqueue_style('bs_vite-style', get_stylesheet_uri());
  wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));
	// wp_enqueue_style('bs_vite-form-styler-css', get_template_directory_uri() . '/assets/libs/jquery-form-styler/jquery.formstyler.css');
	// wp_enqueue_style('bs_vite-form-styler-css-theme', get_template_directory_uri() . '/assets/libs/jquery-form-styler/jquery.formstyler.theme.css');

?>
