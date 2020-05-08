<template>
    <div v-on:mousemove="handleMouseMovement" class="d-flex justify-content-center align-items-center">
        <h2>ALQA</h2>         
    </div>
</template>

<script>
    export default {
        props: {
            viewportWidth: {
                type: Number,
                required: true
            },
            viewportHeight: {
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
                maxScrollX: 0,
                maxScrollY: 0             
            };
        },
        methods: {
            handleMouseMovement (event) {
                this.currentMousePosition.x = event.clientX;
                this.currentMousePosition.y = event.clientY;
                
                var shouldScrollLeft = (this.currentMousePosition.x < this.previousMousePosition.x);
                var shouldScrollRight = (this.currentMousePosition.x > this.previousMousePosition.x);
                var shouldScrollUp = (this.currentMousePosition.y < this.previousMousePosition.y);
                var shouldScrollDown = (this.currentMousePosition.y > this.previousMousePosition.y);

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

                this.maxScrollX = (documentWidth - this.viewportWidth);
                this.maxScrollY = (documentHeight - this.viewportHeight);
                
                // Get the current scroll position of the document.
                this.currentScrollPosition.x = window.pageXOffset;
                this.currentScrollPosition.y = window.pageYOffset;
 
				// Determine if the window can be scrolled in any particular direction.
				var canScrollUp = (this.currentScrollPosition.y > 0);
				var canScrollDown = (this.currentScrollPosition.y < this.maxScrollY);
				var canScrollLeft = (this.currentScrollPosition.x > 0);
				var canScrollRight = (this.currentScrollPosition.x < this.maxScrollX);
 
				// Since we can potentially scroll in two directions at the same time,
				// let's keep track of the next scroll, starting with the current scroll.
				// Each of these values can then be adjusted independently in the logic
				// below.
				var nextScrollX = this.currentScrollPosition.x;
				var nextScrollY = this.currentScrollPosition.y;
 
				// As we examine the mouse position within the edge, we want to make the
				// incremental scroll changes more "intense" the closer that the user
				// gets the viewport edge. As such, we'll calculate the percentage that
				// the user has made it "through the edge" when calculating the delta.
				// Then, that use that percentage to back-off from the "max" step value.
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
 
				// Sanitize invalid maximums. An invalid scroll offset won't break the
				// subsequent .scrollTo() call; however, it will make it harder to
				// determine if the .scrollTo() method should have been called in the
				// first place.
				nextScrollX = Math.max(0, Math.min(this.maxScrollX, nextScrollX));
                nextScrollY = Math.max(0, Math.min(this.maxScrollY, nextScrollY));
                this.previousMousePosition.x = this.currentMousePosition.x;
                this.previousMousePosition.y = this.currentMousePosition.y;
 
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