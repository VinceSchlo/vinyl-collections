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
import ArtistEdit from './components/artist/edit.vue';

// Vinyl components
import VinylIndex from './components/vinyl/index.vue';
import VinylCreate from './components/vinyl/create.vue';

// Genres components
import GenreIndex from './components/genre/index.vue';
import GenreCreate from './components/genre/create.vue';
import GenreEdit from './components/genre/edit.vue';


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
    {
        path: '/artists/:id/edit',
        name: 'artistEdit',
        component: ArtistEdit
    },
    // Vinyl routes
    {
        path: '/vinyls',
        name: 'vinyls',
        component: VinylIndex
    },
    {
        path: '/vinyls/create',
        name: 'vinylCreate',
        component: VinylCreate
    },
    // Genres routes
    {
        path: '/genres',
        name: 'genres',
        component: GenreIndex
    },
    {
        path: '/genres/create',
        name: 'genreCreate',
        component: GenreCreate
    },
    {
        path: '/genres/:id/edit',
        name: 'genreEdit',
        component: GenreEdit
    },
];


export default new VueRouter({
    history: true,
    mode: 'history',
    routes
})