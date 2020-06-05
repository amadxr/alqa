<template>
    <div 
        v-on:mousemove="handleMouseMovement" 
        class="d-flex justify-content-center align-items-center" 
        :style="{ backgroundImage: `url('${this.wallpaperUrl}')` }">
        <h2>ALQA</h2>         
    </div>
</template>

<script>
    export default {
        props: {
            wallpaperUrl: {
                type: String
            },
            maxScrollX: {
                type: Number,
                required: true
            },
            maxScrollY: {
                type: Number,
                required: true
            }
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
                
				var maxStep = 3;
 
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
