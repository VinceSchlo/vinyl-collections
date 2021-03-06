/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router';

Vue.use(VueRouter)
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

import App from './components/app'
import Loader from './components/loader'

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});