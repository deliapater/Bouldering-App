import './bootstrap';
import '../css/app.css';
import { createApp, h } from 'vue';
import store from './store';
import router from './router';
import App from './App.vue';

createApp(App)
.use(store)
.use(router)
.mount('#app');