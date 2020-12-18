<template>
    <div class="absolute flex items-center w-screen h-screen">
        <div class="w-wall h-wall">
            <div
                @click="toggleModal" v-on:mousemove="handleMouseMovement"
                id="wallpaper"
                class="w-auto overflow-visible bg-center bg-cover translate-wall h-wall"
                :style="backgroundStyles(wallpaper.url)">
            </div>
        </div>
        <button
            @click="toggleMenu"
            class="fixed top-0 right-0 w-10 h-10 mt-6 mr-6 uppercase rounded-full bg-alqa-charcoal">
        </button>
        <modal-component v-if="showModal" @close="showModal = false">
            <div slot="first">
                <p>Disculpa la molestia,</p>
                <p>momentáneamente estamos</p>
                <p>trabajando para mejorar</p>
                <p>tu experiencia</p>
                <p>en nuestro sitio web.</p>
            </div>
            <div slot="second">
                <p>Si necesitas ponerte en contacto con nosotros</p>
                <p>escríbenos a hola@alqagaleria.com</p>
                <p>y con gusto te atenderemos.</p>
            </div>
        </modal-component>
        <transition name="slide">
            <nav-component v-show="showMenu" @close="showMenu = false">
                <div slot="list">
                    <p>Nosotros</p>
                    <p>Contacto</p>
                    <p>Cuadernos de Cultura</p>
                    <p>Lista de Deseos</p>
                    <p>Agenda tu Visita</p>
                </div>
            </nav-component>
        </transition>
    </div>
</template>

<style>
    .translate-wall {
        transition:all .5s ease-out;
    }
    .slide-enter-active {
      animation: menu-slide .5s;
    }
    .slide-leave-active {
      animation: menu-slide .5s reverse;
    }
    @keyframes menu-slide {
      from {
        transform: translateX(100%);
      }
      to {
        transform: translateX(0);
      }
    }
</style>

<script>
    export default {
        created () {
            this.fetchWallpaper();
        },
        mounted () {
            this.getMeasurements();
            this.prepareForInteraction();
        },
        data () {
            return {
                maxScrollX: 0,
                maxScrollY: 0,
                wallpaper: {
                    'url': null,
                    'active': false,
                },
                currentScrollPosition: {
                    x: 0,
                    y: 0,
                },
                previousMousePosition: {
                    x: 0,
                    y: 0,
                },
                currentMousePosition: {
                    x: 0,
                    y: 0,
                },
                showModal: false,
                showMenu: false,
            };
        },
        methods: {
            fetchWallpaper () {
                axios.get(process.env.MIX_APP_URL + 'api/wallpapers')
                    .then(response => {
                        this.setWallpaper(response);
                    });
            },

            backgroundStyles (image) {
                return {
                    'background-image': `url(${image})`,
                }
            },

            getMeasurements () {
                var viewportWidth = document.documentElement.clientWidth;
                var viewportHeight = document.documentElement.clientHeight;

                var documentWidth = document.getElementById('wallpaper').offsetWidth;
                var documentHeight = document.getElementById('wallpaper').offsetHeight;

                this.maxScrollX = (documentWidth - viewportWidth);
                this.maxScrollY = (documentHeight - viewportHeight);
            },

            prepareForInteraction () {
                this.currentScrollPosition.x = this.maxScrollX / 2;
                this.currentScrollPosition.y = this.maxScrollY / 2;
                history.scrollRestoration = 'manual';
            },

            setWallpaper (response) {
                let wallpaper = response.data.data.wallpaper;

                if (wallpaper !== null) {
                    this.wallpaper.url = wallpaper.image.url;
                    this.wallpaper.active = wallpaper.active;
                }
            },

            handleMouseMovement (event) {
                // Verify in what direction the window should move.
                this.currentMousePosition.x = event.clientX;
                this.currentMousePosition.y = event.clientY;

                var deltaX = this.currentMousePosition.x - this.previousMousePosition.x;
                var deltaY = this.currentMousePosition.y - this.previousMousePosition.y;

                // Figure out how much should the gallery wall move.
                var wallWidth = document.getElementById('wallpaper').offsetWidth;
                var wallHeight = document.getElementById('wallpaper').offsetHeight;
                var viewportWidth = document.documentElement.clientWidth;
                var viewportHeight = document.documentElement.clientHeight;
                var distanceX = wallWidth * deltaX * 1 / viewportWidth;
                var distanceY = wallHeight + deltaY * -1 / viewportHeight;

                // Let's move the gallery wall.
                var wall = document.getElementById("wallpaper");
                wall.style.transform = "translate(" + distanceX + "px, " + distanceY + "px)";

                // Should we scroll left?
                //if (shouldScrollLeft && canScrollLeft) {
                    //nextScrollX = (nextScrollX - maxStep);
                // Should we scroll right?
                //} else if (shouldScrollRight && canScrollRight) {
                    //nextScrollX = (nextScrollX + maxStep);
                //}
                // Should we scroll up?
                //if (shouldScrollUp && canScrollUp) {
                    //nextScrollY = (nextScrollY - maxStep);
                // Should we scroll down?
                //} else if (shouldScrollDown && canScrollDown) {
                    //nextScrollY = (nextScrollY + maxStep);
                //}

                //nextScrollX = Math.max(0, Math.min(this.maxScrollX, nextScrollX));
                //nextScrollY = Math.max(0, Math.min(this.maxScrollY, nextScrollY));

                // Save the current mouse position for the next time
                this.previousMousePosition.x = this.currentMousePosition.x;
                this.previousMousePosition.y = this.currentMousePosition.y;
            },

            toggleModal () {
                this.showModal = !this.showModal;
            },

            toggleMenu () {
                this.showMenu = !this.showMenu;
            },
        }
    }
</script>
