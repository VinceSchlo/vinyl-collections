<template>
    <div class="container">
        <div class="row">
            <h2>Ma collection</h2>
            <router-link :to="{name: 'collectionAdd'}" class="btn btn-default">Ajouter un Vinyle</router-link>
        </div>
        <Loader v-if="vinylCollection.length <= 0" />
        <div v-else class="row">
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
                    <tr v-for="(vinyl, index) in vinylCollection" :key="index">
                        <td>{{ vinyl.id }}</td>
                        <td>{{ vinyl.name }}</td>
                        <td>{{ vinyl.date }}</td>
                        <td>{{ vinyl.format }}</td>
                        <td>
                                <table class="table table-striped">
                                    <tbody>
                                    <tr v-for="(track, index) in vinyl.tracklist" :key="index">
                                        <td>{{ track.title }}</td>
                                        <td>{{ track.duration }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                        </td>
                        <td>{{ vinyl.artist.name }}</td>
                        <td v-if='vinyl.genre'>{{ vinyl.genre.name }}</td>
                        <td><button class="btn btn-warning" @click="removeVinyl(vinyl.id)">Remove</button></td>
                    </tr>
                    <tr>
                        <td v-if="success" class="alert alert-success mt-3" colspan="8"> Vinyl supprimé de votre collection !</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import 'axios'
    import Loader from '../loader'

    export default {
        data() {
            return {
                vinylCollection: [],
                success: false
            }
        },
        methods: {
            getCollectionFromApi: function () {
                return axios.get(`/api/collections/${this.$userId}`);
            },
            removeVinyl: function(id) {
                axios.post(`/api/users/${this.$userId}`, {
                    user_id: this.$userId,
                    vinyl_id: id,
                    _method: 'delete' })
                .then(response => {
                    this.success = true;
                    this.getCollectionFromApi().then((result) => {
                        this.vinylCollection = result.data.data.collection;
                    })
                })
                .catch(error => { console.log('oups, something went wrong'); });
            }
        },
        created() {
            this.getCollectionFromApi().then((result) => {
                this.vinylCollection = result.data.data.collection;
            })
        },
        components: {
            Loader
        }
    }
</script>