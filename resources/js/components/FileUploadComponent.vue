<template>
    <div class="flex items-center justify-center w-20 h-20 bg-white border-2 border-black">
        <input type="file" @change="handleFileInput" class="hidden" id="customFile">
        <label v-if="value" class="custom-file-label" for="customFile"> {{ value.url }}</label>
        <label v-else class="" for="customFile">Choose file</label>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: File
            }
        },
        methods: {
            handleFileInput (event) {
                this.$emit('input', event.target.files[0]);
            },
        }
    }
</script>
