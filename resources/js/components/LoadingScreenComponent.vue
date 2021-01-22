<template>
    <transition name="loading-screen">
        <div class="fixed top-0 left-0 z-10 flex items-center justify-center w-screen h-screen text-6xl font-alqa-special bg-wall">
                <p>Please wait while we process your request!</p>
        </div>
    </transition>
</template>

<style>
    .loading-screen-enter-active,
    .loading-screen-leave-active {
        transition: all .3s ease-in;
    }

    .loading-screen-enter,
    .loading-screen-leave-to {
        opacity: 0;
    }
</style>

<script>
    export default {
    }
</script>
