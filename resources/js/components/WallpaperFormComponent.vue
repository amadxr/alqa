<template>
    <div>
        <div class="alert alert-success" v-if="messages.success">
            <strong>Success!</strong> {{ messages.success }}
        </div>
        <div>
            <form method="post" @submit.prevent="onSubmit">
                <div class="form-group">
                    <small v-if="wallpaper.url" id="url" class="text-muted">{{ wallpaper.url }}</small>
                    <small v-else id="url" class="text-muted">{{ messages.info }}</small>
                    <file-upload-component
                        v-model="file"
                    />
                    <span v-if="errors.file" class="help-block text-danger">{{ errors.file[0] }}</span>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input id="activitySwitch" name="activitySwitch" type="checkbox" class="custom-control-input" v-model="wallpaper.active">
                        <label class="custom-control-label" for="activitySwitch">Should this wallpaper be active?</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        created () {
            this.fetchWallpaper();
        },
        data () {
            return {
                messages: {
                    info: null,
                    success: null
                },
                errors: [],
                wallpaper: {
                    url: null,
                    active: false
                },
                file: null,
            };
        },
        methods: {
            fetchWallpaper () {
                axios
                    .get(process.env.MIX_APP_URL + 'api/wallpapers')
                    .then(response => {
                        this.setMessages(response);
                        this.setWallpaper(response);
                    });
            },

            onSubmit () {
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                };

                let formData = new FormData();
                let json = JSON.stringify({
                    'wallpaper': this.wallpaper,
                });

                formData.append('data', json);

                if (this.file) {
                    formData.append('file', this.file);
                }

                axios
                    .post(process.env.MIX_APP_URL + 'api/wallpapers', formData, config)
                    .then(response => {
                        this.setMessages(response);
                        this.setWallpaper(response);
                        this.resetForm();
                    })
                    .catch(error => {
                        this.setErrors(error.response);
                        this.resetForm();
                    });
            },

            setWallpaper (response) {
                let wallpaper = response.data.data.wallpaper;

                if (wallpaper !== null) {
                    this.wallpaper.url = wallpaper.image.url;
                    this.wallpaper.active = wallpaper.active;
                }
            },

            setMessages (response) {
                let messages = response.data.messages;
                
                this.messages.success = messages.success;
                this.messages.info = messages.info;
            },

            setErrors (response) {
                this.errors = response.data.errors;
            },

            resetForm () {
                this.file = null;
            },
        }
    }
</script>
