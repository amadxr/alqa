<template>
    <div>
        <div class="custom-file">
            <input type="file" @change="handleFileInput" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: Object
            }
        },
        methods: {
            handleFileInput (event) {
                this.$emit('input', event.target.files[0]);
            },
        }
    }
</script>
