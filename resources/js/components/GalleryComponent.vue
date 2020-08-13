<template>
    <div 
        @click="toggleModal" v-on:mousemove="handleMouseMovement"
        class="h-screen w-screen">
        <img class="absolute z-0" v-bind:src="wallpaper.url">
        <modal-component v-if="showModal">
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
    </div>
</template>

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

            prepareForInteraction () {
                this.currentScrollPosition.x = this.maxScrollX / 2;
                this.currentScrollPosition.y = this.maxScrollY;
                window.scrollTo(this.currentScrollPosition.x, this.currentScrollPosition.y);
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
                
                var shouldScrollLeft = (this.currentMousePosition.x < this.previousMousePosition.x);
                var shouldScrollRight = (this.currentMousePosition.x > this.previousMousePosition.x);
                var shouldScrollUp = (this.currentMousePosition.y < this.previousMousePosition.y);
                var shouldScrollDown = (this.currentMousePosition.y > this.previousMousePosition.y);
                
                // Get the current scroll position of the document.
                this.currentScrollPosition.x = window.pageXOffset;
                this.currentScrollPosition.y = window.pageYOffset;
 
				// Determine if the window can be scrolled in any particular direction.
				var canScrollUp = (this.currentScrollPosition.y > 0);
				var canScrollDown = (this.currentScrollPosition.y < this.maxScrollY);
				var canScrollLeft = (this.currentScrollPosition.x > 0);
				var canScrollRight = (this.currentScrollPosition.x < this.maxScrollX);
 
				// Let's figure out the next scroll coordinates
				var nextScrollX = this.currentScrollPosition.x;
                var nextScrollY = this.currentScrollPosition.y;
                
				var maxStep = 10;
 
				// Should we scroll left?
				if (shouldScrollLeft && canScrollLeft) {
					nextScrollX = (nextScrollX - maxStep);
				// Should we scroll right?
				} else if (shouldScrollRight && canScrollRight) {
					nextScrollX = (nextScrollX + maxStep);
				}
				// Should we scroll up?
				if (shouldScrollUp && canScrollUp) {
					nextScrollY = (nextScrollY - maxStep);
				// Should we scroll down?
				} else if (shouldScrollDown && canScrollDown) {
					nextScrollY = (nextScrollY + maxStep);
				}
 
 				nextScrollX = Math.max(0, Math.min(this.maxScrollX, nextScrollX));
                nextScrollY = Math.max(0, Math.min(this.maxScrollY, nextScrollY));

				// Save the current mouse position for the next time
                this.previousMousePosition.x = this.currentMousePosition.x;
                this.previousMousePosition.y = this.currentMousePosition.y;
 
                // Move window if there's space to move
				if (
					(nextScrollX !== this.currentScrollPosition.x) ||
					(nextScrollY !== this.currentScrollPosition.y)
					) {
					window.scrollTo(nextScrollX, nextScrollY);
				}
            },

            toggleModal () {
                this.showModal = !this.showModal;
            },
        }
    }
</script>
