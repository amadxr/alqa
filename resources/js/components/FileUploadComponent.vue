<template>
    <div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" @change="handleFileInput" class="custom-file-input" id="customFile">
                <label v-if="value" class="custom-file-label" for="customFile"> {{ value.url }}</label>
                <label v-else class="custom-file-label" for="customFile">Choose file</label>
            </div>
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
