<template>
    <transition name="modal">
        <div class="fixed top-0 left-0 z-10 flex items-center justify-center w-screen h-screen bg-white bg-opacity-25"
            @click="closeModal">
            <div class="px-10 py-20 border border-solid h-card w-card bg-wall border-wall-alt">
                <div class="pb-20 text-center first-p-color font-alqa-special text-first-p-size leading-11">
                    <slot name="first">
                        default first paragraph
                    </slot>
                </div>
                <div class="px-12 italic text-center second-p-color text-second-p-size font-alqa-special leading-8">
                    <slot name="second">
                        default second paragraph
                    </slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<style>
    .modal-enter-active,
    .modal-leave-active {
        transition: all .3s ease-in;
    }

    .modal-enter,
    .modal-leave-to {
        opacity: 0;
    }
</style>

<script>
    export default {
        methods: {
            closeModal () {
                this.$emit('close');
            },
        },
    }
</script>
