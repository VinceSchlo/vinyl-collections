<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <router-link :to="{ name: 'collections' }" class="page-title link">My collection</router-link> / Add a new vinyl to collection
            </div>
        </div>
        <div class="row row-margin-top">
            <div class="col-12">
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label for="vinyl_id">Vinyls in the database</label>
                        <select name="vinyl_id" id="vinyl_id" v-model="fields.id">
                            <option disabled>Select a vinyl</option>
                            <option v-for="(vinyl, index) in vinyls.data" :value='vinyl.id' :key="index">{{ vinyl.name }}</option>
                        </select>
                        <div v-if="errors && errors.id" class="text-danger">{{ errors.id[0] }}</div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div v-if="success" class="row alert alert-success mt-3">
            Vinyl successfully added to your collection!
        </div>
    </div>
</template>

<script>
import 'axios'

export default {
    data() {
        return {
            vinyls: {},
            fields: {},
            errors: {},
            success: null
        }
    },
    methods: {
        getVinylsFromApi: function () {
            return axios.get('/api/vinyls')
        },
        getVinylsFromApi: function () {
            return axios.get('/api/vinyls')
        },
        submit() {
            this.success = false;
            this.errors = {};
            axios.post(`/api/users/${this.$userId}`, { vinyl: this.fields, user_id: this.$userId, _method: 'patch'} ).then(response => {
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
        vm.getVinylsFromApi().then(result => {
            let vinyls
            vm.vinyls = result.data
        })
    },
}
</script>