<?php
if (!defined('ABSPATH')) exit;

$home_intro = get_field('home_intro');
$title = $home_intro['title'] ?? '';
$text  = $home_intro['text']  ?? '';
$image = $home_intro['image'] ?? null;
?>

<section class="home-intro js-home-intro">
  <div class="home-intro__wrap">
    <div class="home-intro__content">
      <?php if ($title) : ?>
        <h1 class="home-intro__title"><?php echo esc_html($title); ?></h1>
      <?php endif; ?>
      <?php if ($text) : ?>
        <p class="home-intro__text"><?php echo esc_html($text); ?></p>
      <?php endif; ?>
    </div>
    <?php if ($image) : ?>
      <div class="home-intro__image">
        <img
          src="<?php echo esc_url($image['url']); ?>"
          alt="<?php echo esc_attr($image['alt']); ?>"
        />
      </div>
    <?php endif; ?>
  </div>
</section>
