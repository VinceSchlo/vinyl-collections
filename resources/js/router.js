import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);
/*
    Import des composants
 */
import Home from './components/home.vue';
import ArtistIndex from './components/artist/index.vue';

// 2. Définition des routes
// Chaque route doit être mappée à un composant
const routes =
[
    {
        path: '/',
        name: 'home',
        component: Home
    },
    // Artist routes
    {
        path: '/artists',
        name: 'artists',
        component: ArtistIndex
    },
];


export default new VueRouter({
    history: true,
    mode: 'history',
    routes
})