<script setup lang="ts">
import { PropType } from 'vue';
import { IAbout } from '@/modules/home/IHomeResponse';

defineProps({
  about: {
    type: Object as PropType<IAbout>,
    required: true
  }
});
</script>

<template>
  <section class="about">
    <div class="about__wrap">
      <div class="about__header">
        <h2 class="about__title">
          {{ about.title }}
        </h2>
        <p class="about__text">
          {{ about.text }}
        </p>
      </div>
      <ul class="about__list">
        <li
          v-for="(item, index) in about.items"
          :key="index"
          class="about__item">
          <div class="about__item-image">
            <img
              :src="item.image.url"
              :alt="item.image.alt" />
          </div>
          <h3 class="about__item-subtitle">
            {{ item.subtitle }}
          </h3>
          <p
            class="about__item-text"
            v-html="item.text"></p>
        </li>
      </ul>
      <a
        href="#"
        class="about__btn">
        {{ about.button_text }}
      </a>
    </div>
  </section>
</template>
