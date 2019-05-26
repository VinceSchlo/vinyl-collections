<template>
<div class="container">
 
    <div class="row">
        <h2>Tous les artistes</h2>
        <router-link :to="{name: 'artistCreate'}" class="btn btn-default">Ajouter un Artiste</router-link>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                <td>ID</td>
                <td>Nom</td>
                <td colspan="3">Action</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(artist, index) in artists.data" :key="index">
                    <td>{{artist.id}}</td>
                    <td>{{artist.name}}</td>
                    <td><router-link :to="{name: 'artistEdit', params: {id: artist.id }}" class="btn btn-warning">Edit</router-link></td>
                    <td>
                        <form @submit.prevent="destroy(artist.id)">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                <!-- <td><a href="{{ route('artists.show', ['artist' => $artist->id] ) }}" class="btn btn-success">Show</a></td> -->
            </tbody>
        </table>
        <div class="pagination">
            <b-pagination
                    v-model="artists.meta.current_page"
                    :total-rows="artists.meta.to"
                    :per-page="artists.meta.perPage"
                    aria-controls="my-table"
            ></b-pagination>
        </div>
    </div>
</div>
</template>

<script>
    import 'axios'

    export default {
        data() {
            return {
                artists: [],
                error: {},
                artist: {}
            }
        },
        methods: {
            getArtistsFromApi: function () {
                return axios.get('/api/artists');
            },
            destroy: function (id) {
                axios.post(`/api/artists/${id}`, { _method: 'delete' }).then(response => {
                    this.success = true;

                    this.getArtistsFromApi().then((result) => {
                        this.artists = result.data;
                    })

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.error = error.response.data.errors || {};
                    }
                    if (error.response.status === 500) {
                        this.error = "Impossible de supprimer cet artiste";
                    }
            });
            }
        },
        created() {
            let vm = this;
            vm.getArtistsFromApi().then((result) => {
                    let artists;
                    vm.artists = result.data;
                })
        }
    }
</script>