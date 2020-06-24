<template>
    <div class="vh-100">
        <wall-component
            v-bind:max-scroll-x="this.maxScrollX"
            v-bind:max-scroll-y="this.maxScrollY"
            v-bind:wallpaper="this.wallpaper"
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
                    height: '235%',
                    width: '160%',
                    backgroundColor: '#E8E5D1',
                },
                wallpaper: {
                    'url': null,
                    'active': false,
                },
                maxScrollX: 0,
                maxScrollY: 0
            };
        },
        methods: {
            fetchWallpaper () {
                axios.get(process.env.MIX_APP_URL + 'api/wallpapers')
                    .then(response => {
                        this.setWallpaper(response);
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
            },

            setWallpaper (response) {
                let wallpaper = response.data.data.wallpaper;

                if (wallpaper !== null) {
                    this.wallpaper.url = wallpaper.image.url;
                    this.wallpaper.active = wallpaper.active;
                }
            },
        }
    }
</script>
