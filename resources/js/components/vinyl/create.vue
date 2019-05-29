<template>
<div class="container">
    <div class="row">
        <div class="col-12">
            <router-link :to="{ name: 'vinyls' }" class="page-title link">Vinyls</router-link> / Create a new vinyl
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="name" v-model="fields.name"/>
                    <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="date">Release date</label>
                    <input type="date" class="form-control" name="date" v-model="fields.date"/>
                    <div v-if="errors && errors.date" class="text-danger">{{ errors.date[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="tracklist">Tracklist</label>
                    <input type="text" class="form-control" name="tracklist" v-model="fields.tracklist"/>
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
                    <select name="artist_id" id="artist_id" v-model="fields.artist_id">
                        <option v-for="(artist, index) in artists.data" :value='artist.id' :key="index">{{ artist.name }}</option>
                    </select>
                    <div v-if="errors && errors.artist_id" class="text-danger">{{ errors.artist_id[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="genre_id">Genre</label>
                    <select name="genre_id" id="genre_id" v-model="fields.genre_id">
                        <option v-for="(genre, index) in genres.data" :value='genre.id' :key="index">{{ genre.name }}</option>
                    </select>
                </div>
<!--                <div class="form-group">-->
<!--                    <label for="pochette_id">Cover</label>-->
<!--                    <select name="pochette_id" id="pochette_id" v-model="fields.pochette_id">-->
<!--                        <option v-for="(pochette, index) in pochettes.data" :value='pochette.id' :key="index">{{ pochette.illustrator }}</option>-->
<!--                    </select>-->
<!--                </div>-->
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" id="image" ref="file" @change="processFile"/>
                    <div v-if="errors && errors.image" class="text-danger">{{ errors.image[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="illustrator">Illustrateur</label>
                    <input type="text" class="form-control" name="illustrator" id="illustrator" v-model="fields.illustrator"/>
                    <div v-if="errors && errors.illustrator" class="text-danger">{{ errors.illustrator[0] }}</div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            <div v-if="success" class="alert alert-success mt-3">
                Vinyl created !
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
            fields: {},
            artists: {},
            genres: {},
            pochettes: {},
            errors: {},
            success: false,
            loaded: true,
        }
    },
    methods: {
        submit() {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();

                formData.append('file', this.file);
                formData.append('illustrator', this.fields.illustrator);

                formData.append('name', this.fields.name)
                formData.append('date', this.fields.date)
                formData.append('tracklist', this.fields.tracklist)
                formData.append('format', this.fields.format)
                formData.append('artist_id', this.fields.artist_id)
                formData.append('genre_id', this.fields.genre_id)
                // formData.append('pochette_id', this.fields.pochette_id)

                axios.post('/api/vinyls', formData, config).then(response => {
                    console.log(this.fields)
                    this.fields = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                    this.$router.push({ name: 'vinyls'});
                }).catch(error => {
                    console.log(this.fields)
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        },
        getArtistsFromApi() {
            return axios.get(`/api/artists`);
        },
        getGenresFromApi() {
            return axios.get(`/api/genres`);
        },
        getPochettesFromApi() {
            return axios.get(`/api/pochettes`);
        },
        processFile(e) {
            console.log(e.target.files[0]);
            this.file = e.target.files[0];
        }
    },
    mounted() {
        let vm = this;
        vm.getArtistsFromApi().then((result) => {
                vm.artists = result.data;
            })
        vm.getGenresFromApi().then((result) => {
                vm.genres = result.data;
            })
        vm.getPochettesFromApi().then((result) => {
                vm.pochettes = result.data;
            })
    }
}
</script>