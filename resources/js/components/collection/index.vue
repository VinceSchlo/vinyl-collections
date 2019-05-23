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
                    <td>Genre</td>
                    <td colspan="3">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vinyl, index) in collection" :key="index">
                        <td>{{ vinyl.id }}</td>
                        <td>{{ vinyl.name }}</td>
                        <td>{{ vinyl.date }}</td>
                        <td>{{ vinyl.format }}</td>
                        <td>{{ vinyl.tracklist }}</td>
                        <td>{{ vinyl.artist.name }}</td>
                        <td v-if='vinyl.genre'>{{ vinyl.genre.name }}</td>
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
                collection: {}
            }
        },
        methods: {
            getCollectionFromApi: function () {
                return axios.get(`/api/collections/${this.$userId}`);
            },
        },
        created() {
            let vm = this;
            vm.getCollectionFromApi().then((result) => {
                    let collection;
                    vm.collection = result.data.data;
                })

        }
    }
</script>