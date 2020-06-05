<template>
    <div class="vh-100">
        <wall-component
            v-bind:max-scroll-x="this.maxScrollX"
            v-bind:max-scroll-y="this.maxScrollY"
            v-bind:wallpaper-url="this.wallpaperUrl"
            :style="wallStyle"
        /> 
    </div>
</template>

<script>
    export default {
        created () {
            this.fetchWallpaper();
        },
        mounted () {
            this.getMeasurements()
        },
        data () {
            return {
                wallStyle: {
                    height: '130%',
                    width: '110%',
                },
                wallpaperUrl: '',
                maxScrollX: 0,
                maxScrollY: 0
            };
        },
        methods: {
            fetchWallpaper () {
                axios.get(process.env.MIX_APP_URL + 'api/wallpaper')
                    .then(({data}) => {
                        this.wallpaperUrl = data.data.url;
                    });
            },

            getMeasurements () {
                var viewportWidth = document.documentElement.clientWidth;
                var viewportHeight = document.documentElement.clientHeight;

                var documentWidth = Math.max(
                    document.body.scrollWidth,
                    document.body.offsetWidth,
                    document.body.clientWidth,
                    document.documentElement.scrollWidth,
                    document.documentElement.offsetWidth,
                    document.documentElement.clientWidth
                );

                var documentHeight = Math.max(
                    document.body.scrollHeight,
                    document.body.offsetHeight,
                    document.body.clientHeight,
                    document.documentElement.scrollHeight,
                    document.documentElement.offsetHeight,
                    document.documentElement.clientHeight
                );

                this.maxScrollX = (documentWidth - viewportWidth);
                this.maxScrollY = (documentHeight - viewportHeight);
            }
        }
    }
</script>
