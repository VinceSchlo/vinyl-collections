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
        <div class="row row-margin-top">
            <div class="col-4">
                <img :src="getPochette()" class="img-fluid vinyl-cover">
            </div>
            <div class="col-8">
                <h2>{{ vinyl.name }}</h2>
                <p>{{ vinyl.artist.name }}</p>
                <p><span v-if="vinyl.genre">{{ vinyl.genre.name }}</span><span v-else><i>unknown genre</i></span> &middot; {{ vinyl.date.substring(0,4) }} &middot; {{ vinyl.format }} tours</p>
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
                vinyl: {},
                success: false
            }
        },
        methods: {
            getVinyl: function () {
                return axios.get(`/api/vinyls/${this.id}`);
            },
            getTracklist: function() {
                let config = { headers: { 'Access-Control-Allow-Methods': 'GET,PUT,PATCH,POST,DELETE', 'Access-Control-Allow-Origin': '*', 'Content-Type': 'application/json', 'Access-Control-Allow-Headers': 'Content-Type' } };
                // const tracklist_id = this.vinyl.tracklist;
                return axios.get('https://api.discogs.com/masters/1203', config);
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

            vm.getTracklist().then((result) => {
                vm.vinyl.tracklist_content = result.tracklist;
            }).catch(error => {
                console.log(error);

            })
        }
    }
</script>