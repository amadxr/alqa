<template>
    <div class="flex items-center justify-center w-20 h-20 overflow-hidden bg-gray-100 rounded-lg">
        <img v-if="value" class="object-cover w-full h-20" :src="this.url"/>
        <label v-else class="text-xs">Click to Pick!
            <input type="file" @change="handleFileInput" class="hidden">
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: Object
            }
        },
        created () {
            if (this.value != null) {
                this.url = this.value.url;
            }
        },
        data () {
            return {
                url: null,
            };
        },
        methods: {
            handleFileInput (event) {
                let file = event.target.files[0];
                this.url = URL.createObjectURL(file);
                this.$emit('input', file);
            },
        }
    }
</script>
