<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { axiosInstance } from '@/src/vue/utils/axios-instances';
import { IHomeResponse } from '@/modules/home/IHomeResponse';
import HomeIntro from '@/modules/home-intro/HomeIntro.vue';
import About from '@/modules/about/About.vue';
import Banner from '@/modules/banner/Banner.vue';
import Brand from '@/modules/brand/Brand.vue';

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
  <About
    v-if="home && home.about"
    :about="home.about" />
  <Banner
    v-if="home && home.banner"
    :banner="home.banner" />
  <Brand
    v-if="home && home.brand"
    :brand="home.brand" />
</template>
