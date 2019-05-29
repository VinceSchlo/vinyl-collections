<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p><span class="page-title">Covers</span> / Create a new cover</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" name="image" id="image" ref="file" @change="processFile"/>
                        <div v-if="errors && errors.image" class="text-danger">{{ errors.image[0] }}</div>
                    </div>
                    <div class="form-group">
                        <label for="illustrator">Illustrator</label>
                        <input type="text" class="form-control" name="illustrator" id="illustrator" v-model="fields.illustrator"/>
                        <div v-if="errors && errors.illustrator" class="text-danger">{{ errors.illustrator[0] }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        <div v-if="success" class="row alert alert-success mt-3">
            <div class="col-12">
                Cover successfully created!
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    import 'axios'
    import { log } from 'util';

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