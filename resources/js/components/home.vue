<template>
<div class="container">
    <div class="container">
        <div class="row">
            <h2>Artistes</h2>
        </div>
        <div class="row">
            <router-link :to="{name: 'artists'}" class="btn btn-default">Tous les Artistes</router-link>
            <router-link :to="{name: 'artistCreate'}" class="btn btn-default">Ajouter un Artiste</router-link>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Genres</h2>
        </div>
        <div class="row">
            <router-link :to="{name: 'genres'}" class="btn btn-default">Tous les Genres</router-link>
            <router-link :to="{name: 'genreCreate'}" class="btn btn-default">Ajouter un Genre</router-link>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Vinyles</h2>
        </div>
        <div class="row">
            <router-link :to="{name: 'vinyls'}" class="btn btn-default">Tous les Vinyles</router-link>
            <router-link :to="{name: 'vinylCreate'}" class="btn btn-default">Ajouter un Vinyle</router-link>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Collection</h2>
        </div>
        <div class="row">
            <router-link :to="{name: 'collections'}" class="btn btn-default">Afficher ma collection</router-link>
            <router-link :to="{name: 'collectionAdd'}" class="btn btn-default">Ajouter un Vinyle à ma collection</router-link>
        </div>
    </div>
</div>
</template>

    <script>
    export default {}
    </script>