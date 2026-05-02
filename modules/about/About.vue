<script setup lang="ts">
import { PropType } from 'vue';
import { IAbout } from '@/modules/home/IHomeResponse';

const props = defineProps({
  about: {
    type: Object as PropType<IAbout>,
    required: true
  }
});
</script>

<template>
  <section class="about"></section>
</template>
