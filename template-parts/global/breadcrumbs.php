<?php
$news_page_id = 149;
?>
<ul class="breadcrumbs">
  <li>
    <a href="" onclick="if (history.length > 1) { history.back(); return false; }">
      <div class="breadcrumbs__icon">
        <?php get_template_part('template-parts/icons/icon-back'); ?>
      </div>
    </a>
  </li>
  <li>
    <a href="<?php echo get_the_permalink($news_page_id); ?>"><?php echo get_the_title($news_page_id); ?></a>
  </li>
  <li>
    <span><?php echo get_the_title(); ?></span>
  </li>
</ul>
