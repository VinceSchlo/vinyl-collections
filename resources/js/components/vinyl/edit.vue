<template>
<div class="container">
    <div class="row">
        <form @submit.prevent="submit">
            <!-- @method('PATCH') -->
            <div class="form-group">
                <label for="name">Titre</label>
                <input type="text" class="form-control" id="name" name="name" v-model="fields.name"/>
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>
            <div class="form-group">
                <label for="date">Date de sortie</label>
                <input type="date" class="form-control" id="date" name="date" v-model="fields.date"/>
                <div v-if="errors && errors.date" class="text-danger">{{ errors.date[0] }}</div>
            </div>
            <div class="form-group">
                <label for="tracklist">Tracklist</label>
                <input type="text" class="form-control" id="tracklist" name="tracklist" v-model="fields.tracklist"/>
                <div v-if="errors && errors.tracklist" class="text-danger">{{ errors.tracklist[0] }}</div>
            </div>
            <div class="form-group">
                <label for="format">Format</label>
                <input type="radio" name="format" value="33" v-model="fields.format"><label for="format">33T</label>
                <input type="radio" name="format" value="45" v-model="fields.format"><label for="format">45T</label>
                <div v-if="errors && errors.format" class="text-danger">{{ errors.format[0] }}</div>
            </div>
            <div class="form-group">
                <label for="artist_id">Artiste</label>
                <select name="artist_id" id="artist_id" v-model="fields.artist_id">
                    <option disabled>Artiste actuel : {{ fields.artist.name }}</option>
                    <option v-for="(artist, index) in artists.data" :value='artist.id' :key='index'>{{ artist.name }}</option>
                </select>
                <div v-if="errors && errors.artist_id" class="text-danger">{{ errors.artist_id[0] }}</div>
            </div>
            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select name="genre_id" id="genre_id" v-model="fields.genre_id">
                    <option disabled>Genre actuel : {{ fields.genre.name }}</option>
                    <option v-for="(genre, index) in genres.data" :value='genre.id' :key='index'>{{ genre.name }}</option>
                </select>
            </div>
            <!--<div class="form-group">
                <select name="pochette-id" id="pochette">
                    @foreach ($pochettes as $pochette)
                        <option value="{{ $pochette->id }}">{{ $pochette->illustrator }}</option>
                    @endforeach
                </select>
            </div> -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <div v-if="success" class="alert alert-success mt-3">
            Vinyle modifié !
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
                artist_id: this.fields.artist_id,
                genre_id: this.fields.genre_id,
                _method: 'patch'
            }).then(response => {
                this.success = true;
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
        }

    },
    mounted() {
        let vm = this;
        vm.init().then((result) => {
            let fields;
            vm.fields = result.data.data;
        })
        vm.getArtists().then((response) => {
            let artists;
            vm.artists = response.data;
        }),
        vm.getGenres().then((response) => {
            let genres;
            vm.genres = response.data;
        })
    },

}
</script>