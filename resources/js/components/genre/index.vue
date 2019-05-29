<template>
<div class="container">
    <div class="row justify-content-between">
        <div class="col-2">
            <h2 class="page-title">Genres</h2>
        </div>
        <div class="col-2">
            <router-link :to="{name: 'genreCreate'}" class="btn btn-secondary">Add genre</router-link>
        </div>
    </div>
    <div class="row row-margin-top">
        <table class="table table-striped">
            <thead>
                <tr>
                <th>#</th>
                <th>Name</th>
                <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(genre, index) in genres.data" v-bind:item="genre" v-bind:key="index">
                    <td>{{genre.id}}</td>
                    <td>{{genre.name}}</td>
                    <td><router-link :to="{name: 'genreEdit', params: {id: genre.id }}" class="btn btn-warning">Edit</router-link></td>
                    <td>
                        <form @submit.prevent="destroy(genre.id)">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        <div v-if="success" class="alert alert-success mt-3">
                            Genre supprimé !
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
                genres: []
            }
        },
        methods: {
            getGenresFromApi: function () {
                return axios.get('/api/genres');
            },
            destroy: function (id) {
                axios.post(`/api/genres/${id}`, { _method: 'delete' }).then(response => {
                this.success = true;
                this.getGenresFromApi().then((result) => {
                    this.genres = result.data;
                })
                this.success = true;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
            }
        },
        created() {
            let vm = this;
            vm.getGenresFromApi().then((result) => {
                    let genres;
                    vm.genres = result.data;
                })

        }
    }
</script>