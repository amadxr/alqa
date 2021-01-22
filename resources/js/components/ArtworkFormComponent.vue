<template>
    <div class="overflow-auto">
        <form class="relative flex flex-col items-center flex-1 w-full px-20 py-24 space-y-4" method="post" @submit.prevent="onSubmit">
            <div class="absolute top-0 w-2/3 p-2 m-4 bg-green-300 border-2 border-black rounded-lg" v-if="messages.success">
                <strong>Success!</strong> {{ messages.success }}
            </div>
            <div class="flex flex-row w-full space-x-4">
                <div class="flex flex-col w-2/3 p-4 bg-gray-200 rounded-lg divide-y-2 divide-black">
                    <div class="pb-4">
                        <p>Basic Information</p>
                    </div>
                    <div class="pt-4 space-y-6">
                        <div class="flex flex-col">
                            <input type="text" class="w-2/3 bg-gray-100" id="inputName" placeholder="Name" v-model="artwork.name">
                            <span v-if="errors.data.artwork.name" class="text-sm text-red-500">{{ errors.data.artwork.name[0] }}</span>
                        </div>
                        <div class="flex flex-col">
                            <input type="text" class="w-1/2 bg-gray-100" id="inputOrigin" placeholder="Origin" v-model="artwork.origin">
                            <span v-if="errors.data.artwork.origin" class="text-sm text-red-500">{{ errors.data.artwork.origin[0] }}</span>
                        </div>
                        <div class="flex flex-col">
                            <textarea rows="3" class="w-full bg-gray-100" id="inputText1" placeholder="Text 1" v-model="artwork.text1"></textarea>
                            <span v-if="errors.data.artwork.text1" class="text-sm text-red-500">{{ errors.data.artwork.text1[0] }}</span>
                        </div>
                        <div class="flex flex-col">
                            <textarea rows="3" class="w-full bg-gray-100" id="inputHighlightedText" placeholder="Highlighted Text" v-model="artwork.highlightedText"></textarea>
                            <span v-if="errors.data.artwork.highlightedText" class="text-sm text-red-500">{{ errors.data.artwork.highlightedText[0] }}</span>
                        </div>
                        <div class="flex flex-col">
                            <textarea rows="3" class="w-full bg-gray-100" id="inputText2" placeholder="Text 2" v-model="artwork.text2"></textarea>
                            <span v-if="errors.data.artwork.text2" class="text-sm text-red-500">{{ errors.data.artwork.text2[0] }}</span>
                        </div>
                        <div class="flex flex-col">
                            <textarea rows="3" class="w-full bg-gray-100" id="inputText3" placeholder="Text 3" v-model="artwork.text3"></textarea>
                            <span v-if="errors.data.artwork.text3" class="text-sm text-red-500">{{ errors.data.artwork.text3[0] }}</span>
                        </div>
                        <div class="flex flex-col">
                            <textarea rows="3" class="w-full bg-gray-100" id="inputText4" placeholder="Text 4" v-model="artwork.text4"></textarea>
                            <span v-if="errors.data.artwork.text4" class="text-sm text-red-500">{{ errors.data.artwork.text4[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col flex-1 space-y-4">
                    <div class="p-4 bg-gray-200 rounded-lg divide-y-2 divide-black">
                        <div class="pb-4">
                            <p>Measurements</p>
                        </div>
                        <div class="pt-4 space-y-6">
                            <div class="flex flex-col">
                                <div class="flex flex-row space-x-1">
                                    <input type="text" class="w-1/3 bg-gray-100" id="inputWidth" placeholder="Width" v-model="artwork.width">
                                    <span>cm</span>
                                </div>
                                <span v-if="errors.data.artwork.width" class="text-sm text-red-500">{{ errors.data.artwork.width[0] }}</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex flex-row space-x-1">
                                    <input type="text" class="w-1/3 bg-gray-100" id="inputHeight" placeholder="Height" v-model="artwork.height">
                                    <span>cm</span>
                                </div>
                                <span v-if="errors.data.artwork.height" class="text-sm text-red-500">{{ errors.data.artwork.height[0] }}</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex flex-row space-x-1">
                                    <input type="text" class="w-1/3 bg-gray-100" id="inputDepth" placeholder="Depth" v-model="artwork.depth">
                                    <span>cm</span>
                                </div>
                                <span v-if="errors.data.artwork.depth" class="text-sm text-red-500">{{ errors.data.artwork.depth[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-200 rounded-lg divide-y-2 divide-black">
                        <div class="pb-4">
                            <p>Registry Data</p>
                        </div>
                        <div class="pt-4 space-y-6">
                            <div class="flex flex-col">
                                <input type="text" class="w-2/3 bg-gray-100" id="inputSKU" placeholder="SKU" v-model="artwork.sku" :readonly="art">
                                <span v-if="errors.data.artwork.sku" class="text-sm text-red-500">{{ errors.data.artwork.sku[0] }}</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex flex-row space-x-1">
                                    <span>$</span>
                                    <input type="text" class="w-1/3 bg-gray-100" id="inputPrice" placeholder="Price" v-model="artwork.price">
                                </div>
                                <span v-if="errors.data.artwork.price" class="text-sm text-red-500">{{ errors.data.artwork.price[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col flex-1 p-4 bg-gray-200 rounded-lg divide-y-2 divide-black">
                        <div class="pb-4">
                            <p>Cover Image</p>
                        </div>
                        <div class="flex flex-row items-center justify-center flex-1 pt-4 space-x-8">
                            <p>Most important image. Choose wisely!</p>
                            <file-upload-component
                                v-model="coverImage">
                            </file-upload-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col flex-1 w-full p-4 bg-gray-200 rounded-lg divide-y-2 divide-black">
                <div class="flex flex-row items-center justify-between pb-4">
                    <p>Carousel Images</p>
                    <button type="button" class="flex items-center justify-center w-8 h-8 text-lg rounded-full bg-adobe" @click="addFile('carousel')">+</button>
                </div>
                <div class="flex flex-row pt-4 space-x-2">
                    <file-upload-component
                        v-for="(file, index) in carouselImages" :key="index"
                        v-model="carouselImages[index]">
                    </file-upload-component>
                </div>
            </div>
            <div class="flex flex-col flex-1 w-full p-4 bg-gray-200 rounded-lg divide-y-2 divide-black">
                <div class="flex flex-row items-center justify-between pb-4">
                    <p>Flyer Images</p>
                    <button type="button" class="flex items-center justify-center w-8 h-8 text-lg rounded-full bg-adobe" @click="addFile('flyer')">+</button>
                </div>
                <div class="flex flex-row pt-4 space-x-2">
                    <file-upload-component
                        v-for="(file, index) in flyerImages" :key="index"
                        v-model="flyerImages[index]">
                    </file-upload-component>
                </div>
            </div>
            <div class="absolute top-0 right-0 flex flex-row items-center justify-end w-full h-auto px-20 py-4 space-x-4">
                <switch-component v-if="art" v-model="artwork.forSale"></switch-component>
                <button type="submit" class="p-2 rounded-lg bg-adobe">Submit</button>
            </div>
        </form>
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
                            text1: null,
                            highlightedText: null,
                            text2: null,
                            text3: null,
                            text4: null,
                            width: null,
                            height: null,
                            depth: null,
                            sku: null,
                            price: null,
                        },
                    },
                },
                artwork: {
                    name: null,
                    origin: null,
                    text1: null,
                    highlightedText: null,
                    text2: null,
                    text3: null,
                    text4: null,
                    width: null,
                    height: null,
                    depth: null,
                    sku: null,
                    price: null,
                    forSale: false,
                },
                carouselImages: [],
                coverImage: null,
                flyerImages: [],
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

            addFile (arrayName) {
                let newFile = null;

                if (arrayName == 'carousel') {
                    this.carouselImages.push(newFile);
                } else if (arrayName == 'flyer') {
                    this.flyerImages.push(newFile);
                }
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

                this.carouselImages.forEach((file, index) =>
                    formData.append('carouselImages[' + index + ']', file));

                this.flyerImages.forEach((file, index) =>
                    formData.append('flyerImages[' + index + ']', file));

                formData.append('coverImage', this.coverImage);

                if (this.art) {
                    formData.append('_method', 'PUT');

                    axios
                        .post(process.env.MIX_APP_URL + 'api/artworks/' + this.art, formData, config)
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
                    this.artwork.forSale = artwork.forSale;
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
