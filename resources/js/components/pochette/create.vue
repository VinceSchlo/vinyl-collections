<template>
    <div class="container">
        <h1>Ajouter une nouvelle pochette</h1>
<!--        <router-link :to="{name: 'artists'}" class="btn btn-default">Tous les Artistes</router-link>-->
        <div class="row">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" id="image" ref="file" @change="processFile"/>
                    <div v-if="errors && errors.image" class="text-danger">{{ errors.image[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="illustrator">Illustrateur</label>
                    <input type="text" class="form-control" name="illustrator" id="illustrator" v-model="fields.illustrator"/>
                    <div v-if="errors && errors.illustrator" class="text-danger">{{ errors.illustrator[0] }}</div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            <div v-if="success" class="alert alert-success mt-3">
                Pochette ajoutée !
<!--                {{ file }}-->
<!--                {{ fields }}-->
            </div>
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
                file: '',
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

                    const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                    }

                    let formData = new FormData();
                    /*
                        Add the form data we need to submit
                    */
                    formData.append('file', this.file);
                    formData.append('illustrator', this.fields.illustrator);


                    axios.post('/api/pochettes', formData, config).then(response => {
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
            processFile(e) {
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            }
        },
    }
</script>