<template>
<div class="container">
    <div class="container">
        <div class="row">
            <h2>Artistes</h2>
        </div>
        <div class="row">
            <router-link :to="{name: 'artists'}" class="btn btn-default">Tous les Artistes</router-link>
            <router-link :to="{name: 'artistCreate'}" class="btn btn-default">Ajouter un Artiste</router-link>
            <!-- <a href="{{ route('artists.create') }}" class="btn btn-success">Ajouter Artiste</a>
            <a href="{{ route('artists.index') }}" class="btn btn-default">Tous les Artistes</a> -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Genres</h2>
        </div>
        <div class="row">
            <!-- <a href="{{ route('genres.create') }}" class="btn btn-success">Ajouter Genre</a>
            <a href="{{ route('genres.index') }}" class="btn btn-default">Tous les Genres</a> -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Vinyles</h2>
        </div>
        <div class="row">
            <router-link :to="{name: 'vinyls'}" class="btn btn-default">Tous les Vinyle</router-link>
            <router-link :to="{name: 'vinylCreate'}" class="btn btn-default">Ajouter un Vinyle</router-link>
            <!-- <a href="{{ route('vinyls.create') }}" class="btn btn-success">Ajouter Vinyle</a>
            <a href="{{ route('vinyls.index') }}" class="btn btn-default">Tous les Vinyles</a> -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Collection</h2>
        </div>
        <div class="row">
            <!-- <router-link :to="{name: 'vinyls'}" class="btn btn-default">Tous les Vinyle</router-link> -->
            <router-link :to="{name: 'collectionAdd'}" class="btn btn-default">Ajouter un Vinyle à ma collection</router-link>
            <!-- <a href="{{ route('vinyls.create') }}" class="btn btn-success">Ajouter Vinyle</a>
            <a href="{{ route('vinyls.index') }}" class="btn btn-default">Tous les Vinyles</a> -->
        </div>
    </div>
</div>
</template>

    <script>
    export default {}
    </script>