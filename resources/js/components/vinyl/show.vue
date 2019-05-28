<template>
    <div class="container">
        <div class="row">
            <h2>{{ vinyl.name }}</h2>
            <router-link :to="{name: 'vinylCreate'}" class="btn btn-default">Ajouter un Vinyle</router-link>
        </div>
        <div class="row">
            <p>Nom : {{ vinyl.name }}</p>
        </div>
        <div class="row">
            <p> Date : {{ vinyl.date }}</p>
        </div>
        <div class="row">
            <p> Format : {{ vinyl.format }}</p>
        </div>
        <div class="row">
            <p> Tracklist : {{ vinyl.tracklist_content }}</p>
            <ul>
                <li v-for="(track, index) in vinyl.tracklist"> {{ track.title }} </li>
            </ul>
        </div>
        <div class="row">
            <p> Artiste : {{ vinyl.artist.name }}</p>
        </div>
        <div class="row">
            <p v-if='vinyl.genre'>Genre : {{ vinyl.genre.name }}</p>
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