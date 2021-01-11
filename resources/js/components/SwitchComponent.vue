<template>
    <div class="flex items-center justify-between space-x-2" @click="toggleSwitch">
        <span>Active for Sale</span>
        <div class="flex items-center w-16 h-10 p-1 bg-gray-300 rounded-full" :class="{ 'bg-green-400': value }">
            <div class="w-8 h-8 bg-white rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-6': value }"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: Boolean
            }
        },
        methods: {
            toggleSwitch () {
                this.$emit('input', !this.value);
            },
        }
    }
</script>
