<?php
global $footer_page_id;
$footer = get_field('footer', $footer_page_id);
$phone_number = $footer['phone_number'];
$whatsapp = $footer['whatsapp'];
$email = $footer['email'];
$full_address = $footer['full_address'];
$google_url = $footer['google_url'];
$hours = $footer['hours'];
$socials = $footer['socials'];
$form_title = $footer['form_title'];
$form_text = $footer['form_text'];
$map = get_field('map', 'option');
$coords_map = $map['coords_map'];
$map_icon = $map['map_icon'];
$zoom = $map['zoom'];
$address_text = $map['address_text'];


$cookie_notice = get_field('cookies_notice', $footer_page_id);
$cookie_text = $cookie_notice['text'];
$cookie_button_text = $cookie_notice['button_text'];
?>
<div class="footer-top">
  <div class="footer-top__wrap">
    <div class="footer-top__left">
      <div class="footer-top__content">
        <div class="footer-top__label">Telefono</div>
        <ul class="footer-top__list">
          <li>
            <div class="footer-top__icon">
              <?php get_template_part('template-parts/icons/icon-tel'); ?>
            </div>
            <a href="tel:<?php echo clear_phone($phone_number); ?>" target="_blank"><?php echo $phone_number; ?></a>
          </li>
          <li>
            <div class="footer-top__icon">
              <?php get_template_part('template-parts/icons/icon-whatsapp'); ?>
            </div>
            <a href="https://wa.me/<?php echo clear_phone($whatsapp); ?>" target="_blank"><?php echo $whatsapp; ?></a>
          </li>
        </ul>
        <div class="footer-top__label">Mail</div>
        <ul class="footer-top__list">
          <li>
            <div class="footer-top__icon">
              <?php get_template_part('template-parts/icons/icon-email'); ?>
            </div>
            <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
          </li>
        </ul>
        <div class="footer-top__label">Indirizzo</div>
        <ul class="footer-top__list">
          <li>
            <div class="footer-top__icon">
              <?php get_template_part('template-parts/icons/icon-address'); ?>
            </div>
            <a href="<?php echo $google_url; ?>" target="_blank"><?php echo $full_address; ?></a>
          </li>
        </ul>
        <div class="footer-top__label">Orari di apertura</div>
        <ul class="footer-top__list">
          <li>
            <div class="footer-top__icon">
              <?php get_template_part('template-parts/icons/icon-clock'); ?>
            </div>
            <span><?php echo $hours; ?></span>
          </li>
        </ul>
        <ul class="footer-top__socials">
          <?php foreach ($socials as $item) : ?>
            <?php
            $icon = $item['icon'];
            $url = $item['url'];
            ?>
            <li>
              <a href="<?php echo $url; ?>" target="_blank">
                <?php echo $icon; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="footer-top__right">
      <h2 class="footer-top__title"><?php echo $form_title; ?></h2>
      <div class="footer-top__text"><?php echo $form_text; ?></div>
      <div class="footer-top__form form">
        <?php echo do_shortcode('[contact-form-7 id="e096b1c" title="Footer"]'); ?>
      </div>
    </div>
  </div>
  <span id="map-address" style="display: none;">
    <?php echo $address_text; ?>
  </span>
  <span id="map-coords" style="display: none;">
    <?php echo $coords_map; ?>
  </span>
  <span id="map-icon" style="display: none;"><?php echo $map_icon; ?></span>
  <span id="map-zoom" style="display: none;"><?php echo $zoom; ?></span>
  <div id="map" style="margin-bottom: 6.4rem;height: 38rem;"></div>
</div>
<div class="main-footer">
</div>

<div id="cookie-notice-text" style="display: none;"><?php echo $cookie_text; ?></div>
<div id="cookie-notice-button-text" style="display: none;"><?php echo $cookie_button_text; ?></div>
