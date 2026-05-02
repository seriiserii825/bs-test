<script setup lang="ts">
import { PropType } from 'vue';
import { IHomeIntro } from '@/modules/home/IHomeResponse';

const props = defineProps({
  homeIntro: {
    type: Object as PropType<IHomeIntro>,
    required: true
  }
});
</script>

<template>
  <section class="home-intro">
    <div class="home-intro__wrap">
      <div class="home-intro__content">
        <h1 class="home-intro__title">
          {{ homeIntro.title }}
        </h1>
        <p class="home-intro__text">
          {{ homeIntro.text }}
        </p>
      </div>

      <div class="home-intro__image">
        <img
          :src="homeIntro.image.url"
          :alt="homeIntro.image.alt" />
      </div>
    </div>
  </section>
</template>
