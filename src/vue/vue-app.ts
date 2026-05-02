import { Component, createApp } from 'vue';
import HomeView from '@/modules/home/HomeView.vue';
// createVueApp('#vueSearch', SearchView);
createVueApp('#vueHome', HomeView);

function createVueApp(id: string, component: Component) {
  if (document.querySelector(id)) {
    const app = createApp(component);
    app.mount(id);
  }
}
