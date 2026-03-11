<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { axiosInstance } from '../utils/axios-instances';

const value = ref('');

async function getSearch() {
  const res = await axiosInstance.get('page/v1/search?title=');
  console.log('res', res);

  const schemaDoc = await fetch('/wp-json/page/v1/search/schema').then((r) =>
    r.json()
  );
  console.log('schemaDoc', schemaDoc);
}

onMounted(async () => {
  await getSearch();
});
</script>

<template>
  <div class="vue-search">
    <input
      v-model="value"
      type="text"
      placeholder="Search..."
    />
  </div>
</template>
