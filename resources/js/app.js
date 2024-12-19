import './bootstrap';
import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { createRouter, createWebHistory } from 'vue-router';
import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init();

createInertiaApp({
    resolve: name => import(`./Pages/${name}.vue`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            // .use(router) 
            .mount(el);
    },
});

// const router = createRouter({
//     history: createWebHistory(),
//     routes: [
//       {
//         path: '/techniques',
//         name: 'Techniques/Index',
//         component: () => import('./Pages/Techniques/Index.vue'),
//       }
//     ],
//   });