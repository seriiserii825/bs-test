<?php

/**
 * Template Name: Front page
 */
get_header();
?>
<?php get_template_part('modules/home-intro/home-intro'); ?>
<?php echo do_shortcode('[vue-home]') ?>
<?php get_footer(); ?>
