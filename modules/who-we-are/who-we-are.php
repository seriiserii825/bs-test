<?php
if (!defined('ABSPATH')) exit;

$who_we_are = get_field('who_we_are');
$title = $who_we_are['title'] ?? '';
$text  = $who_we_are['text']  ?? '';
?>

<section class="who-we-are">
  <div class="who-we-are__wrap">
    <?php if ($title) : ?>
      <h2 class="who-we-are__title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
    <?php if ($text) : ?>
      <p class="who-we-are__text"><?php echo esc_html($text); ?></p>
    <?php endif; ?>
  </div>
</section>
