<template>
    <div class="container">
        <div class="row">
            <h2>Ma collection</h2>
            <router-link :to="{name: 'collectionAdd'}" class="btn btn-default">Ajouter un Vinyle</router-link>
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
                    <tr v-for="(vinyl, index) in vinylCollection" :key="index">
                        <td>{{ vinyl.id }}</td>
                        <td>{{ vinyl.name }}</td>
                        <td>{{ vinyl.date }}</td>
                        <td>{{ vinyl.format }}</td>
                        <td>{{ vinyl.tracklist }}</td>
                        <td>{{ vinyl.artist.name }}</td>
                        <td v-if='vinyl.genre'>{{ vinyl.genre.name }}</td>
                        <td><button class="btn btn-warning" @click="removeVinyl(vinyl.id)">Remove</button></td>
                        <!-- <td><a href="{{ route('vinyls.edit', ['vinyl' => $vinyl->id] ) }}" class="btn btn-warning">Edit</a></td>
                        <td>
                            <form action="{{ route('vinyls.destroy', ['vinyl' => $vinyl->id]) }} " method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                        <td><a href="{{ route('vinyls.show', ['vinyl' => $vinyl->id] ) }}" class="btn btn-success">Show</a></td> -->
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
        }
    }
</script>