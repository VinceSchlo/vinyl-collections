<template>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-2">
                <router-link :to="{ name: 'vinyls' }" class="page-title link">Vinyls</router-link> / {{ vinyl.name }}
            </div>
            <div class="col-2">
                <router-link :to="{name: 'vinylEdit', params: {id: vinyl.id }}" class="btn btn-warning">Edit</router-link>
                <button class="btn btn-danger" @click="destroy(vinyl.id)">Delete</button>
            </div>
        </div>
        <Loader v-if="vinyl.length <= 0" />
        <div v-else class="row row-margin-top">
            <div class="col-4">
                <img :src="getPochette()" class="img-fluid vinyl-cover">
            </div>
            <div class="col-8">
                <h2>{{ vinyl.name }}</h2>
                <p>{{ vinyl.artist.name }}</p>
                <p><span v-if="vinyl.genre">{{ vinyl.genre.name }}</span><span v-else><i>unknown genre</i></span> &middot; {{ vinyl.date.substring(0,4) }} &middot; {{ vinyl.format }} tours</p>
            </div>
            <p> Tracklist : {{ vinyl.tracklist_content }}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <td>Track</td>
                    <td>duration</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(track, index) in vinyl.tracklist" :key="index">
                        <td>{{ track.title }}</td>
                        <td>{{ track.duration }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import 'axios'
    import Loader from '../loader'

    export default {
        components: {
            Loader
        },
        data() {
            return {
                id: this.$route.params.id,
                vinyl: [],
                success: false
            }
        },
        methods: {
            getVinyl: function () {
                return axios.get(`/api/vinyls/${this.id}`);
            },
            getPochette: function() {
                return `/storage/${this.vinyl.pochette.image}`;
            },
            destroy: function (id) {
                axios.post(`/api/vinyls/${id}`, { _method: 'delete' }).then(response => {
                this.success = true;
                this.$router.push({ name: 'vinyls' });
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
            }
        },
        mounted() {
            let vm = this;
            vm.getVinyl().then((result) => {
                vm.vinyl = result.data.data;
            });
        }
    }
</script>