<template>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-2">
                <h2 class="page-title">Vinyls</h2>
            </div>
            <div class="col-2">
                <router-link :to="{name: 'vinylCreate'}" class="btn btn-secondary">Add vinyl</router-link>
            </div>
        </div>
        <div v-if="vinyls.length <= 0" class="row justify-content-center row-margin-top">
            <Loader/>
        </div>
        <div v-else class="row row-margin-top">
            <div v-for="(vinyl, index) in vinyls.data" :key="index" class="col-3">
                <router-link :to="{name: 'vinylShow', params: {id: vinyl.id}}"><img :src="getPochette(vinyl)" class="img-fluid vinyl-cover"></router-link>
                <h3 class="vinyl-title"><router-link :to="{name: 'vinylShow', params: {id: vinyl.id}}" class="link">{{ vinyl.name }}</router-link></h3>
                <p class="vinyl-artist">{{ vinyl.artist.name }}</p>
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
                vinyls: [],
                success: false,
            }
        },
        methods: {
            getVinylsFromApi: function () {
                return axios.get('/api/vinyls');
            },
            // destroy: function (id) {
            //     axios.post(`/api/vinyls/${id}`, { _method: 'delete' }).then(response => {
            //     this.success = true;

            //     this.getVinylsFromApi().then((result) => {
            //         this.vinyls = result.data;
            //     })
            // }).catch(error => {
            //     if (error.response.status === 422) {
            //         this.errors = error.response.data.errors || {};
            //     }
            // });
            // },
            getPochette: function(vinyl) {
                return `/storage/${vinyl.pochette.image}`;
            }
        },
        created() {
            let vm = this;
            vm.getVinylsFromApi().then((result) => {
                let vinyls;
                vm.vinyls = result.data;
            })

        },
        components: {
            Loader
        }
    }
</script>