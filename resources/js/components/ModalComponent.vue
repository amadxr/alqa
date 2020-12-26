<template>
    <transition name="modal">
        <div class="fixed top-0 left-0 z-10 flex items-center justify-center w-screen h-screen bg-white bg-opacity-25"
            @click="closeModal">
            <div class="w-4/6 h-auto px-1 py-5 border border-solid lg:px-10 lg:py-20 lg:h-card lg:w-card bg-wall border-wall-alt">
                <div class="pb-5 text-lg text-center lg:text-first-p-size lg:pb-20 first-p-color font-alqa-special lg:leading-11">
                    <slot name="first">
                        default first paragraph
                    </slot>
                </div>
                <div class="text-xs italic text-center lg:text-second-p-size lg:px-12 second-p-color font-alqa-special lg:leading-8">
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
