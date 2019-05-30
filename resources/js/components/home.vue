<template>
<div class="container">
    <div class="container">
        <div class="row"> <!--d-flex justify-content-center-->
            <div class="col-12 text-center">
                <h2>Welcome to Vinyls Collections!</h2>
                <p>You'll find below the latest vinyls added to our database. <br>Add those you own to your collection, <br>and start keeping track of your records today!</p>
                <p></p>
                <router-link :to="{name: 'vinyls'}" class="btn btn-secondary text-center">See all Vinyls</router-link>
            </div>
        </div>
        <!-- <div class="row justify-content-between row-margin-top">
            <h2>Most recent vinyls</h2>
            <router-link :to="{name: 'vinyls'}" class="btn btn-secondary">See all Vinyls</router-link>
        </div> -->
        <div class="row row-margin-top justify-content-center">
            <div class="col-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" :src="getPochette(recentVinyls[0])" alt="First slide">
                            <div class="carousel-caption d-md-block">
                                <h5>{{recentVinyls[0].name }}</h5>
                                <p>{{ recentVinyls[0].artist.name }} &middot; {{ recentVinyls[2].date.substring(0,4) }}</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" :src="getPochette(recentVinyls[1])" alt="Second slide">
                            <div class="carousel-caption d-md-block">
                                <h5>{{recentVinyls[1].name }}</h5>
                                <p>{{ recentVinyls[1].artist.name }} &middot; {{ recentVinyls[1].date.substring(0,4) }}</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" :src="getPochette(recentVinyls[2])" alt="Third slide">
                            <div class="carousel-caption d-md-block">
                                <h5>{{recentVinyls[2].name }}</h5>
                                <p>{{ recentVinyls[2].artist.name }} &middot; {{ recentVinyls[2].date.substring(0,4) }}</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- <div class="row row-margin-top">
            <div v-for="(vinyl, index) in recentVinyls" :key="index" class="col-4">
                <router-link :to="{name: 'vinylShow', params: {id: vinyl.id}}"><img :src="getPochette(vinyl)" class="img-fluid vinyl-cover"></router-link>
                <h3 class="vinyl-title"><router-link :to="{name: 'vinylShow', params: {id: vinyl.id}}" class="link">{{ vinyl.name }}</router-link></h3>
                <p class="vinyl-artist">{{ vinyl.artist.name }}</p>
            </div>
        </div> -->
    </div>
    <!-- <div class="container">
        <div class="row justify-content-between row-margin-top">
            <h2>Most recent artists</h2>
            <router-link :to="{name: 'artists'}" class="btn btn-secondary">See all Artists</router-link>
        </div>
        <div class="row row-margin-top">
            <div v-for="(artist, index) in recentArtists" :key="index" class="col-4">
                <h3 class="vinyl-title">#{{artist.id}} {{ artist.name }}</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-between row-margin-top">
            <h2>Latest genres</h2>
            <router-link :to="{name: 'genres'}" class="btn btn-secondary">See all Genres</router-link>
        </div>
        <div class="row row-margin-top">
            <div v-for="(genre, index) in recentGenres" :key="index" class="col-4">
                <h3 class="vinyl-title">#{{genre.id}} {{ genre.name }}</h3>
            </div>
        </div>
    </div> -->
    <!-- <div class="container">
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
    </div> -->
</div>
</template>

<script>
import 'axios'

export default {
    data() {
        return {
            recentVinyls: [],
            recentArtists: [],
            recentGenres: [],
        }
    },
    methods: {
        getThreeVinyls: function() {
            return axios.get('/api/vinyls'); // récupérer seulement les trois derniers avec les query parameters
        },
        // getThreeArtists: function() {
        //     let allArtists = axios.get('/api/artists');
        //     return allArtists;
        // },
        // getThreeGenres: function() {
        //     return axios.get('/api/genres');
        // },
        getPochette: function(vinyl) {
            return `/storage/${vinyl.pochette.image}`;
        }
    },
    mounted() {
        let vm = this;
        vm.getThreeVinyls().then((response) => {
            let recentVinyls;
            vm.recentVinyls = response.data.data;
        })
        // vm.getThreeArtists().then((response) => {
        //     let recentArtists;
        //     vm.recentArtists = response.data.data;
        // })
        // vm.getThreeGenres().then((response) => {
        //     let recentGenres;
        //     vm.recentGenres = response.data.data;
        // })
    }
}
</script>