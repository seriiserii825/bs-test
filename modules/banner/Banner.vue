<script setup lang="ts">
import { PropType } from 'vue';
import { IBanner } from '../home/IHomeResponse';

defineProps({
  banner: {
    type: Object as PropType<IBanner>,
    required: true
  }
});
</script>

<template>
  <div class="banner">
    <img
      :src="banner.image.url"
      :alt="banner.image.alt" />
  </div>
</template>
