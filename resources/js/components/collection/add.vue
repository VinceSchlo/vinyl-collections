<template>
    <div class="container">
        <div class="row">
            <h1>Ajouter une vinyle à ma collection</h1>
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="vinyl_id">Vinyl</label>
                    <select name="vinyl_id" id="vinyl_id" v-model="fields.id">
                        <option v-for="(vinyl, index) in vinyls.data" :value='vinyl.id' :key="index">{{ vinyl.name }}</option>
                    </select>
                    <div v-if="errors && errors.id" class="text-danger">{{ errors.id[0] }}</div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
            <div v-if="success" class="alert alert-success mt-3">
                Vinyl ajouté à votre collection!
            </div>
        </div>
    </div>
</template>collections

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