<template>
<div class="container">
    <div class="row">
        <div class="col-12">
            <router-link :to="{ name: 'vinyls' }" class="page-title link">Vinyls</router-link> / Edit <i>{{ fields.name }}</i>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <form @submit.prevent="submit">
                <!-- @method('PATCH') -->
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" id="name" name="name" v-model="fields.name"/>
                    <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="date">Release date</label>
                    <input type="date" class="form-control" id="date" name="date" v-model="fields.date"/>
                    <div v-if="errors && errors.date" class="text-danger">{{ errors.date[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="tracklist">Tracklist</label>
                    <input type="text" class="form-control" id="tracklist" name="tracklist" v-model="fields.track_id"/>
                    <div v-if="errors && errors.tracklist" class="text-danger">{{ errors.tracklist[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="format">Format</label>
                    <input type="radio" name="format" value="33" v-model="fields.format"><label for="format">33T</label>
                    <input type="radio" name="format" value="45" v-model="fields.format"><label for="format">45T</label>
                    <div v-if="errors && errors.format" class="text-danger">{{ errors.format[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="artist_id">Artist</label>
                    <select name="artist_id" id="artist_id" v-model="fields.artist.id">
                        <option disabled>Current artist : {{ fields.artist.name }}</option>
                        <option v-for="(artist, index) in artists.data" :value='artist.id' :key='artist.id'>{{ artist.name }}</option>
                    </select>
                    <div v-if="errors && errors.artist_id" class="text-danger">{{ errors.artist_id[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="genre_id">Genre</label>
                    <select name="genre_id" id="genre_id" v-model="fields.genre.id">
                        <option disabled>Current genre : {{ fields.genre.name }}</option>
                        <option v-for="(genre, index) in genres.data" :value='genre.id' :key='genre.id'>{{ genre.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pochette_id">Cover</label>
                    <select name="pochette_id" id="pochette_id" v-model="fields.pochette.id">
                        <option disabled>Current cover : {{ fields.pochette.illustrator }}</option>
                        <option v-for="(pochette, index) in pochettes.data" :value='pochette.id' :key="index">{{ pochette.illustrator }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <div v-if="success" class="alert alert-success mt-3">
                Vinyl updated !
            </div>
        </div>
    </div>
</div>
</template>

<script>
import 'axios'

export default {
    data() {
        return {
            id: this.$route.params.id,
            fields: {},
            genres: {},
            artists: {},
            pochettes: {},
            errors: {},
            success: false,
        }
    },
    methods: {
        submit() {
            this.success = false;
            this.errors = {};
            axios.post(`/api/vinyls/${this.id}`, {
                name: this.fields.name,
                date: this.fields.date,
                tracklist: this.fields.tracklist,
                format: this.fields.format,
                artist_id: this.fields.artist.id,
                genre_id: this.fields.genre.id,
                pochette_id: this.fields.pochette.id,
                _method: 'patch'
            }).then(response => {
                this.success = true;
                // console.log(reponse);
                this.$router.push(`/vinyls/${this.id}/show` );
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },
        init() {
            return axios.get(`/api/vinyls/${this.id}`);
        },
        getArtists() {
            return axios.get(`/api/artists`);
        },
        getGenres() {
            return axios.get(`/api/genres`);
        },
        getPochettes() {
            return axios.get(`/api/pochettes`);
        }

    },
    mounted() {
        let vm = this;
        vm.init().then((result) => {
            let fields;
            vm.fields = result.data.data;
        }),
        vm.getArtists().then((response) => {
            let artists;
            vm.artists = response.data;
        }),
        vm.getGenres().then((response) => {
            let genres;
            vm.genres = response.data;
        }),
        vm.getPochettes().then((response) => {
            let pochettes;
            vm.pochettes = response.data;
        })
    },

}
</script>