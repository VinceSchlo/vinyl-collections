<template>
    <div class="container">
        <div class="row">
            <h2>{{ vinyl.name }}</h2>
            <router-link :to="{name: 'vinylCreate'}" class="btn btn-default">Ajouter un Vinyle</router-link>
        </div>
        <div class="row">
            <p>nom : {{ vinyl.name }}</p>
        </div>
        <div class="row">
            <p> date : {{ vinyl.date }}</p>
        </div>
        <div class="row">
            <p> format : {{ vinyl.format }}</p>
        </div>
        <div class="row">
            <p> tracklist : {{ vinyl.tracklist_content }}</p>
        </div>
        <div class="row">
            <p> artiste : {{ vinyl.artist.name }}</p>
        </div>
        <div class="row">
            <p v-if='vinyl.genre'>genre : {{ vinyl.genre.name }}</p>
            <p v-else><i>unknown</i></p>
        </div>
        <div class="row">
            <p><router-link :to="{name: 'vinylEdit', params: {id: id }}" class="btn btn-warning">Edit Vinyle</router-link></p>
        </div>
    </div>
</template>

<script>
    import 'axios'

    export default {
        data() {
            return {
                id: this.$route.params.id,
                vinyl: {}
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