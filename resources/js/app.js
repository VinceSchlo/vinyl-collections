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

import App from './components/app'

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});