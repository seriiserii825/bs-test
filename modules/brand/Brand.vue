<script setup lang="ts">
import { PropType } from 'vue';
import { IBrand } from '../home/IHomeResponse';

defineProps({
  brand: {
    type: Object as PropType<IBrand>,
    required: true
  }
});
</script>

<template>
  <section class="brand">
    <div class="brand__wrap">
      <h2 class="brand__title">{{ brand.title }}</h2>
      <div class="brand__image">
        <img
          :src="brand.image.url"
          :alt="brand.image.alt" />
      </div>
    </div>
  </section>
</template>
