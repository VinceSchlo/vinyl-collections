<template>
    <div class="container">
        <div class="row">
            <h2>Tous les vinyles</h2>
            <router-link :to="{name: 'vinylCreate'}" class="btn btn-default">Ajouter un Vinyle</router-link>
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
                                <li v-for="(track, index) in vinyl.tracklist"> {{ track.title }} </li>
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
                vinyls: {}
            }
        },
        methods: {
            getVinylsFromApi: function () {
                return axios.get('/api/vinyls');
            },
            destroy: function (id) {
                axios.post(`/api/vinyls/${id}`, { _method: 'delete' }).then(response => {
                this.success = true;

                this.getVinylsFromApi().then((result) => {
                    this.vinyls = result.data;
                })
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
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