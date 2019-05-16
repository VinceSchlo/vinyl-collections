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
                <tr v-for="(artist, index) in artists.data">
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
    </div>
</div>
</template>

<script>
    import 'axios'

    export default {
        data() {
            return {
                artists: []
            }
        },
        methods: {
            getArtistsFromApi: function () {
                return axios.get('/api/artists');
            },
            destroy: function (id) {
                axios.post(`/artists/${id}`, { _method: 'delete' }).then(response => {
                this.success = true;
                this.artists = this.artists.splice(id, 1);
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
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