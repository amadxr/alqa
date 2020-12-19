<template>
    <div>
        <div class="alert alert-success" v-if="messages.success">
            <strong>Success!</strong> {{ messages.success }}
        </div>
        <div>
            <form method="post" @submit.prevent="onSubmit">
                <div class="form-group">
                    <input type="text" class="form-control" id="inputName" placeholder="Name" v-model="artwork.name">
                    <span v-if="errors.data.artwork.name" class="help-block text-danger">{{ errors.data.artwork.name[0] }}</span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputOrigin" placeholder="Origin" v-model="artwork.origin">
                    <span v-if="errors.data.artwork.origin" class="help-block text-danger">{{ errors.data.artwork.origin[0] }}</span>
                </div>
                <div class="form-group">
                    <textarea rows="3" class="form-control" id="inputDescription" placeholder="Description" v-model="artwork.description"></textarea>
                    <span v-if="errors.data.artwork.description" class="help-block text-danger">{{ errors.data.artwork.description[0] }}</span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputWidth" placeholder="Width" v-model="artwork.width">
                        <div class="input-group-append">
                            <span class="input-group-text">cm</span>
                        </div>
                    </div>
                    <span v-if="errors.data.artwork.width" class="help-block text-danger">{{ errors.data.artwork.width[0] }}</span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputLength" placeholder="Length" v-model="artwork.length">
                        <div class="input-group-append">
                            <span class="input-group-text">cm</span>
                        </div>
                    </div>
                    <span v-if="errors.data.artwork.length" class="help-block text-danger">{{ errors.data.artwork.length[0] }}</span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputDepth" placeholder="Depth" v-model="artwork.depth">
                        <div class="input-group-append">
                            <span class="input-group-text">cm</span>
                        </div>
                    </div>
                    <span v-if="errors.data.artwork.depth" class="help-block text-danger">{{ errors.data.artwork.depth[0] }}</span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputSKU" placeholder="SKU" v-model="artwork.sku" :readonly="art">
                    <span v-if="errors.data.artwork.sku" class="help-block text-danger">{{ errors.data.artwork.sku[0] }}</span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" id="inputPrice" placeholder="Price" v-model="artwork.price">
                    </div>
                    <span v-if="errors.data.artwork.price" class="help-block text-danger">{{ errors.data.artwork.price[0] }}</span>
                </div>
                <div class="form-group">
                    <p>Image Section</p>
                    <button type="button" class="btn btn-outline-success btn-sm" @click="addFile">Add image</button>
                </div>
                <div class="form-group">
                    <file-upload-component
                        v-for="(file, index) in files" :key="index"
                        v-model="files[index]">
                    </file-upload-component>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            art: {
                type: Number,
                required: false,
            },
        },
        created () {
            this.fetchArtwork();
        },
        data () {
            return {
                messages: {
                    info: null,
                    success: null,
                },
                errors: {
                    data: {
                        artwork: {
                            name: null,
                            origin: null,
                            description: null,
                            width: null,
                            length: null,
                            depth: null,
                            sku: null,
                            price: null,
                        },
                    },
                },
                artwork: {
                    name: null,
                    origin: null,
                    description: null,
                    width: null,
                    length: null,
                    depth: null,
                    sku: null,
                    price: null,
                },
                files: [],
            };
        },
        methods: {
            fetchArtwork () {
                if (this.art) {
                    axios
                        .get(process.env.MIX_APP_URL + 'api/artworks/' + this.art)
                        .then(response => {
                            this.setArtwork(response);
                        });
                }
            },

            addFile () {
                let newFile = null;
                this.files.push(newFile);
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
                    'artwork': this.artwork,
                });

                formData.append('data', json);

                this.files.forEach((file, index) =>
                    formData.append('files[' + index + ']', file));

                if (this.art) {
                    formData.append('_method', 'PUT');

                    axios
                        .post(process.env.MIX_APP_URL + 'api/artworks', formData, config)
                        .then(response => {
                            this.setMessages(response);
                            this.setArtwork(response);
                            this.resetForm();
                        })
                        .catch(error => {
                            this.setErrors(error.response);
                            this.resetForm();
                        });
                } else {
                    axios
                        .post(process.env.MIX_APP_URL + 'api/artworks', formData, config)
                        .then(response => {
                            this.setMessages(response);
                            this.setArtwork(response);
                            this.resetForm();
                        })
                        .catch(error => {
                            this.setErrors(error.response);
                            this.resetForm();
                        });
                }
            },

            setArtwork (response) {
                let artwork = response.data.data.artwork;

                if (artwork !== null) {
                    this.artwork.name = artwork.name;
                    this.artwork.origin = artwork.origin;
                    this.artwork.description = artwork.description;
                    this.artwork.width = artwork.width;
                    this.artwork.length = artwork.length;
                    this.artwork.depth = artwork.depth;
                    this.artwork.sku = artwork.sku;
                    this.artwork.price = artwork.price;
                    this.files = artwork.images;
                }
            },

            setMessages (response) {
                let messages = response.data.messages;

                this.messages.success = messages.success;
                this.messages.info = messages.info;
            },

            setErrors (response) {
                let errors = response.data.errors;

                this.errors.data.artwork.name = errors['data.artwork.name'];
                this.errors.data.artwork.origin = errors['data.artwork.origin'];
                this.errors.data.artwork.description = errors['data.artwork.description'];
                this.errors.data.artwork.width = errors['data.artwork.width'];
                this.errors.data.artwork.length = errors['data.artwork.length'];
                this.errors.data.artwork.depth = errors['data.artwork.depth'];
                this.errors.data.artwork.sku = errors['data.artwork.sku'];
                this.errors.data.artwork.price = errors['data.artwork.price'];
            },

            resetForm () {
                this.file = null;
            },
        }
    }
</script>
