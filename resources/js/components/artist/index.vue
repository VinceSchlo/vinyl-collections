<template>
<div class="container">
    <div class="row justify-content-between">
        <div class="col-2">
            <h2 class="page-title">Artists</h2>
        </div>
        <div class="col-2">
            <router-link :to="{name: 'artistCreate'}" class="btn btn-secondary">Add artist</router-link>
        </div>
    </div>
    <div class="row row-margin-top">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th colspan="3">Action</th>
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
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <button class="page-link" @click="fetchPaginateArtists(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                    Previous
                    </button>
                </li>
                <li class="page-item">
                    <span class="page-link">Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
                </li>
                <li class="page-item">
                    <button class="page-link" @click="fetchPaginateArtists(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                        Next
                    </button>
                </li>
            </ul>
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