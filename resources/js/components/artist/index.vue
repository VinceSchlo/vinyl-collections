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
                <tr v-for="(artist, index) in artists" :key="index">
                    <td>{{artist.id}}</td>
                    <td>{{artist.name}}</td>
                    <td><router-link :to="{name: 'artistEdit', params: {id: artist.id }}" class="btn btn-warning">Edit</router-link></td>
                    <td>
                        <form @submit.prevent="destroy(artist.id)">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button class="btn btn-default" @click="fetchPaginateArtists(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                Previous
            </button>
            <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
            <button class="btn btn-default" @click="fetchPaginateArtists(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                Next
            </button>
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
                artist: {},
                url: '/api/artists',
                pagination: []
            }
        },
        methods: {
            getArtistsFromApi: function () {
                axios.get(this.url).then(response => {
                    this.artists = response.data.data;

                    this.makePagination(response.data)
                })
            },
            destroy: function (id) {
                axios.post(`/api/artists/${id}`, { _method: 'delete' }).then(response => {
                    this.success = true;

                    this.getArtistsFromApi().then((result) => {
                        this.artists = result.data
                    })

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.error = error.response.data.errors || {};
                    }
                    if (error.response.status === 500) {
                        this.error = "Impossible de supprimer cet artiste";
                    }
            });
            },
            makePagination(data){
                let pagination = {
                    current_page: data.meta.current_page,
                    last_page: data.meta.last_page,
                    next_page_url: data.links.next,
                    prev_page_url: data.links.prev
                }

                this.pagination = pagination
            },
            fetchPaginateArtists(url){
                this.url = url
                this.getArtistsFromApi()
            }
        },
        created() {
            this.getArtistsFromApi()
        }
    }
</script>