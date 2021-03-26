//require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';


import App from './vue/App';
import Home from './vue/statics/Home';
import Dashboard from './vue/statics/Dashboard';

import '../css/app.css';

Vue.use(VueRouter);

const routes = [
    { path: "/", component: Home },
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
