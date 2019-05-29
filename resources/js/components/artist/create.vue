<template>
<div class="container">
    <div class="row">
        <div class="col-12">
            <router-link :to="{ name: 'artists' }" class="page-title link">Artists</router-link> / Create a new artist
        </div>
    </div>
    <div class="row">
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" v-model="fields.name"/>
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    <div v-if="success" class="row alert alert-success mt-3">
      Artist successfully created!
    </div>
</div>
</template>



<script>
import 'axios'

export default {
  data() {
    return {
        fields: {},
        errors: {},
        success: false,
        loaded: true,
    }
  },
  methods: {
    submit() {
      if (this.loaded) {
        this.loaded = false;
        this.success = false;
        this.errors = {};
        axios.post('/api/artists', this.fields).then(response => {
            this.fields = {}; //Clear input fields.
            this.loaded = true;
            this.success = true;
        }).catch(error => {
            this.loaded = true;
            if (error.response.status === 422) {
                this.errors = error.response.data.errors || {};
            }
        });
      }
    },
  },
}
</script>