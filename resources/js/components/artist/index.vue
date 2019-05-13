<template>
<div class="container">
 
    <div class="row">
        <h2>Tous les artistes</h2>
        <!-- <a href="{{ route('artists.create') }}" class="btn btn-primary">Ajouter Artiste</a> -->
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
                </tr>
                <!-- <td><a href="{{ route('artists.edit', ['artist' => $artist->id] ) }}" class="btn btn-warning">Edit</a></td> -->
                <!-- <td>
                    <form action="{{ route('artists.destroy', ['artist' => $artist->id]) }} " method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td> -->
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
                let vm = this;
                return axios.get('http://localhost:8000/api/artists');
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