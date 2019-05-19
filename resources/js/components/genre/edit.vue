<template>
<div class="container">
    <div class="row">
        <form @submit.prevent="submit" >
            <!-- @method('PATCH') -->
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" v-model="fields.name"  />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <div v-if="success" class="alert alert-success mt-3">
            Genre modifié !<br>
            <router-link :to="{name: 'genres'}" class="btn btn-default">Retourner aux genres</router-link>
        </div>
    </div>
</div>
</template>

<script>
import 'axios'

export default {
    data() {
        return {
            id: this.$route.params.id,
            fields: {},
            errors: {},
            success: false,
        }
    },
    methods: {
        submit() {
            this.success = false;
            this.errors = {};
            axios.post(`/api/genres/${this.id}`, { name: this.fields.name, _method: 'patch'} ).then(response => {
                this.success = true;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },
        init() {
            return axios.get(`/api/genres/${this.id}`);
        }
    },
    mounted() {
        let vm = this;
        vm.init().then((result) => {
                let fields;
                vm.fields = result.data.data;
            })
    }
}
</script>