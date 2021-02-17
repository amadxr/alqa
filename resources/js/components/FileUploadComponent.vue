<template>
    <div class="flex items-center justify-center w-20 h-20 overflow-hidden bg-gray-100 rounded-lg">
        <img v-if="value" class="object-cover w-full h-20" :src="this.value.url"/>
        <label v-else class="text-xs">Click to Pick!
            <input type="file" @change="handleFileInput" class="hidden">
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            value: null,
        },
        data () {
            return {
            };
        },
        methods: {
            handleFileInput (event) {
                let file = event.target.files[0];

                let value = {
                    'file': file,
                    'url': URL.createObjectURL(file),
                };

                this.$emit('input', value);
            },
        }
    }
</script>
