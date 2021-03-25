//require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './vue/app';
import Home from './vue/statics/Home';
import Dashboard from './vue/statics/Dashboard';

Vue.use(VueRouter);

const routes = [
    { path: "/home", component: Home },
    { path: "/dashboard", component: Dashboard }
];

const router = new VueRouter({
    mode: 'history',
    routes
});


const app = new Vue({
    el: '#app',
    components: { App },
    router
});
