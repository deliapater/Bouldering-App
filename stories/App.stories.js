import App from '../resources/js/App.vue';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    { path: '/', component: { template: '<div>Home Page</div>'} },
    { path: '/techniques', component: { template: '<div>Techniques Page</div>'} },
    { path: '/gear', component: { template: '<div>Gear Page</div>'} },
    { path: '/settings', component: { template: '<div>Setting Page</div>'} },
    { path: '/profile', component: { template: '<div>Profile Page</div>'} }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default {
    title: 'Components/App',
    component: App,
};

const Template = (args) => ({
    components: { App },
    setup() {
        return { args };
    },
    template: '<App />',
    router,
});

export const Default = Template.bind({});
Default.args = {};