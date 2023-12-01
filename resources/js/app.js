require('./bootstrap');
import { createApp } from 'vue'
import App from './App.vue'
import 'primeicons/primeicons.css';
import 'vuetify/styles'
import vuetify from '../js/configs/vuetify';
import { createRouter, createWebHistory } from 'vue-router'
import routes from './configs/routes';
import { createPinia } from 'pinia';
import VueTheMask from 'vue-the-mask'

const router = createRouter({
  routes,
  history: createWebHistory()
});

const app = createApp(App);

app.use(createPinia());
app.use(vuetify);
app.use(router);
app.mount("#app");
app.use(VueTheMask);
