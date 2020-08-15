<template>
    <transition name="modal">
        <div class="fixed top-0 left-0 bg-white bg-opacity-25 z-10 h-screen w-screen flex items-center justify-center"
            @click="closeModal">
            <div class="w-25 px-10 py-20 bg-wall border-solid border border-wall-alt">
                <div class="pb-32 first-p-color text-center font-alqa-special text-first-p-size leading-13">
                    <slot name="first">
                        default first paragraph
                    </slot>
                </div>
                <div class="px-12 second-p-color text-center text-second-p-size font-alqa-special italic leading-8">
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
