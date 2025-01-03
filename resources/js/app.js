import './bootstrap';
import '../css/app.css';
import { createApp, h } from 'vue';
import store from './store';
import router from './router';
import App from './App.vue';
import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css';
import vuetify from './plugins/vuetify';

createApp(App)
.use(store)
.use(router)
.use(vuetify)
.mount('#app');

