<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { axiosInstance } from '../utils/axios-instances';
import { IHomeResponse } from '../interfaces/IHomeResponse';
import HomeIntro from './home/HomeIntro.vue';

const home = ref<IHomeResponse | null>(null);

onMounted(async () => {
  const response = await axiosInstance.get<IHomeResponse>('site/v1/home');
  home.value = response.data;
});
</script>

<template>
  <HomeIntro
    v-if="home && home.home_intro"
    :home-intro="home.home_intro" />
</template>
