<template>
    <div>
        <div class="alert alert-success" v-if="updated">
            <strong>Success!</strong> Your wallpaper has been updated!
        </div>
        <div>
            <form method="post" @submit.prevent="onSubmit">
                <div class="form-group">
                    <small v-if="wallpaper.url" id="url" class="text-muted">{{ wallpaper.url }}</small>
                    <small v-else id="url" class="text-muted">No wallpaper image uploaded yet.</small>
                    <file-upload-component
                        v-model="image"
                    />
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input id="activitySwitch" name="activitySwitch" type="checkbox" class="custom-control-input" v-model="wallpaper.active">
                        <label class="custom-control-label" for="activitySwitch">Should this wallpaper be active?</label>
                        <span v-if="errors.active" class="help-block text-danger">{{ errors.active[0] }}</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                updated: false,
                errors: [],
                wallpaper: {
                    url: null,
                    active: false
                },
                image: null,
            };
        },
        methods: {
            onSubmit () {
                axios.post(process.env.MIX_APP_URL + 'api/wallpaper', this.wallpaper)
                    .then(({data}) => this.setSubmitSuccessMessage())
                    .catch(({response}) => this.setErrors(response));
            },

            setSubmitSuccessMessage () {
                this.updated = true;
            },

            setErrors (response) {
                this.errors = response.data.errors;
            },
        }
    }
</script>
