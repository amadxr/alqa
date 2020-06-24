<template>
    <div 
        v-if="wallpaper.active"
        v-on:mousemove="handleMouseMovement" 
        class="d-flex justify-content-center align-items-center"
        :style="{ 
            backgroundImage: `url('${this.wallpaper.url}')`,
            backgroundPosition: `center`,
            backgroundSize: `cover`,
        }">
        <img class="logo" src="https://alqa.s3.us-east-2.amazonaws.com/display/logo.png">
    </div>
    <div 
        v-else
        v-on:mousemove="handleMouseMovement" 
        class="d-flex justify-content-center align-items-center">
        <img class="logo" src="https://alqa.s3.us-east-2.amazonaws.com/display/logo.png">
    </div>
</template>

<style>
    .logo {
        position: relative;
        top: -235px;
        left: 5px;
        width: 380px;
    }
</style>

<script>
    export default {
        props: {
            maxScrollX: {
                type: Number,
                required: true,
            },
            maxScrollY: {
                type: Number,
                required: true,
            },
            wallpaper: {
                type: Object,
            },
        },
        created () {
            this.prepareSite();
        },
        data () {
            return {
                currentScrollPosition: {
                    x: 0,
                    y: 0
                },
                previousMousePosition: {
                    x: 0,
                    y: 0
                },
                currentMousePosition: {
                    x: 0,
                    y: 0
                },   
            };
        },
        methods: {
            prepareSite () {
                console.log(this.maxScrollY);
                this.currentScrollPosition.x = this.maxScrollX / 2;
                this.currentScrollPosition.y = this.maxScrollY;
                window.scrollTo(this.currentScrollPosition.x, this.currentScrollPosition.y);
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
            }
        }
    }
</script>
