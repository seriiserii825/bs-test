import { Component, createApp } from 'vue';
import SearchView from './views/SearchView.vue';
createVueApp('#vueSearch', SearchView);

function createVueApp(id: string, component: Component) {
  if (document.querySelector(id)) {
    const app = createApp(component);
    app.mount(id);
  }
}
