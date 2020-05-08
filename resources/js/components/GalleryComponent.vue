<template>
    <div class="vh-100">
        <wall-component
            v-bind:viewport-width="this.viewportWidth"
            v-bind:viewport-height="this.viewportHeight"
            :style="wallStyle"
        /> 
    </div>
</template>

<script>
    export default {
        mounted () {
            this.initiateViewportData()
        },
        data () {
            return {
                wallStyle: {
                    height: '130%',
                    width: '110%'
                },
                viewportWidth: 0,
                viewportHeight: 0
            };
        },
        methods: {
            initiateViewportData () {
                this.viewportWidth = document.documentElement.clientWidth;
                this.viewportHeight = document.documentElement.clientHeight;
            }
        }
    }
</script>