<template>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-2">
                <h2 class="page-title">Vinyls</h2>
            </div>
            <div class="col-2">
                <router-link :to="{name: 'vinylCreate'}" class="btn btn-secondary">Add vinyl</router-link>
            </div>
        </div>
        <div class="row row-margin-top">
            <div v-for="(vinyl, index) in vinyls.data" :key="index" class="col-3">
                <router-link :to="{name: 'vinylShow', params: {id: vinyl.id}}"><img :src="getPochette(vinyl)" class="img-fluid vinyl-cover"></router-link>
                <h3 class="vinyl-title"><router-link :to="{name: 'vinylShow', params: {id: vinyl.id}}" class="link">{{ vinyl.name }}</router-link></h3>
                <p class="vinyl-artist">{{ vinyl.artist.name }}</p>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <td>ID</td>
                    <td>Nom</td>
                    <td>Date</td>
                    <td>Format</td>
                    <td>Tracklist</td>
                    <td>Artiste</td>
                    <td>Genre</td>
                    <td colspan="3">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vinyl, index) in vinyls.data" :key="index">
                        <td>{{ vinyl.id }}</td>
                        <td><router-link :to="{name: 'vinylShow', params: {id: vinyl.id}}">{{ vinyl.name }}</router-link></td>
                        <td>{{ vinyl.date }}</td>
                        <td>{{ vinyl.format }}</td>
                        <td>
                            <ul>
                                <li v-for="(track, index) in vinyl.tracklist" :key="index"> {{ track.title }} </li>
                            </ul>
                        </td>
                        <td>{{ vinyl.artist.name }}</td>
                        <td v-if='vinyl.genre'>{{ vinyl.genre.name }}</td>
                        <td v-else><i>unknown</i></td>
                        <td><router-link :to="{name: 'vinylEdit', params: {id: vinyl.id }}" class="btn btn-warning">Edit</router-link></td>
                        <td>
                            <form @submit.prevent="destroy(vinyl.id)">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            <div v-if="success" class="alert alert-success mt-3">
                                Vinyle supprimé !
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import 'axios'

    export default {
        data() {
            return {
                vinyls: {},
                success: false,
            }
        },
        methods: {
            getVinylsFromApi: function () {
                return axios.get('/api/vinyls');
            },
            // destroy: function (id) {
            //     axios.post(`/api/vinyls/${id}`, { _method: 'delete' }).then(response => {
            //     this.success = true;

            //     this.getVinylsFromApi().then((result) => {
            //         this.vinyls = result.data;
            //     })
            // }).catch(error => {
            //     if (error.response.status === 422) {
            //         this.errors = error.response.data.errors || {};
            //     }
            // });
            // },
            getPochette: function(vinyl) {
                return `/storage/${vinyl.pochette.image}`;
            }
        },
        created() {
            let vm = this;
            vm.getVinylsFromApi().then((result) => {
                    let vinyls;
                    vm.vinyls = result.data;
                })

        }
    }
</script>