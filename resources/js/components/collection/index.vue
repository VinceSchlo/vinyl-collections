<template>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-2">
                <h2 class="page-title">My collection</h2>
            </div>
            <div class="col-2">
                <router-link :to="{name: 'collectionAdd'}" class="btn btn-secondary">Add vinyl</router-link>
            </div>
        </div>
        <div v-if="success" class="row row-margin-top alert alert-success mt-3" colspan="8">
            <p>Vinyl successfully deleted from collection!</p>
        </div>
        <Loader v-if="vinylCollection.length <= 0" />
        <div v-else class="row row-margin-top">
            <div v-for="(vinyl, index) in vinylCollection" :key="index" class="col-3">
                <router-link :to="{name: 'collectionShow', params: {id: vinyl.id}}"><img :src="getPochette(vinyl)" class="img-fluid vinyl-cover"></router-link>
                <h3 class="vinyl-title"><router-link :to="{name: 'collectionShow', params: {id: vinyl.id}}" class="link">{{ vinyl.name }}</router-link></h3>
                <p class="vinyl-artist">{{ vinyl.artist.name }}</p>
                <button @click="removeVinyl(vinyl.id)" class="btn btn-danger remove-from-collection">Remove</button>
            </div>
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
            },
            getPochette: function(vinyl) {
                return `/storage/${vinyl.pochette.image}`;
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