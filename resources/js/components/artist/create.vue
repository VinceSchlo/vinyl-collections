<template>
<div class="container">
    <h1>Ajouter un nouvel artiste</h1>
    <div class="row">
        <form @submit.prevent="submit">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" v-model="fields.name"/>
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <div v-if="success" class="alert alert-success mt-3">
            Artiste ajouté !
        </div>
    </div>
</div>
</template>
       


<script>
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
        axios.post('/artists', this.fields).then(response => {
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