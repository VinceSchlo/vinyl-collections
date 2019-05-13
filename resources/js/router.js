import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);
/*
    Import des composants
 */
import Home from './components/home.vue';

// Artist components
import ArtistIndex from './components/artist/index.vue';
import ArtistCreate from './components/artist/create.vue';

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
    {
        path: '/artists/create',
        name: 'artistCreate',
        component: ArtistCreate
    },
];


export default new VueRouter({
    history: true,
    mode: 'history',
    routes
})