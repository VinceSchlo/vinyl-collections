<template>
<div class="container">

    <div class="row">
        <h2>Tous les genres</h2>
        <router-link :to="{name: 'genreCreate'}" class="btn btn-default">Ajouter un Genre</router-link>
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
                this.genres.splice(id, 1);
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