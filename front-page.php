<?php

/**
 * Template Name: Front page
 */
get_header();
?>
<?php get_template_part('modules/home-intro/home-intro'); ?>
<?php echo do_shortcode('[vue-home]') ?>
<?php get_template_part('modules/who-we-are/who-we-are'); ?>
<?php get_footer(); ?>
