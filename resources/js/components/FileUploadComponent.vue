<template>
    <div>
        <div class="custom-file">
            <input type="file" @change="handleFileInput" class="custom-file-input" id="customFile">
            <label v-if="value" class="custom-file-label" for="customFile"> {{ value.name }}</label>
            <label v-else class="custom-file-label" for="customFile">Choose file</label>
        </div>
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
