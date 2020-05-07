<template>
    <div v-on:mousemove="handleMouseMovement" class="d-flex justify-content-center align-items-center">
        <h2>ALQA</h2>         
    </div>
</template>

<script>
    export default {
        data() {
            return {
                edgeSize: 200,
                edgeTop: 0,
                edgeLeft: 0,
                edgeBottom: 0,
                edgeRight: 0,
                currentScrollPosition: {
                    x: 0,
                    y: 0
                },
                mousePosition: {
                    x: 0,
                    y: 0
                },
                isInLeftEdge: false,
                isInRightEdge: false,
                isInTopEdge: false,
                isInBottomEdge: false,
                maxScrollX: 0,
                maxScrollY: 0             
            };
        },
        methods: {
            handleMouseMovement (event) {
                this.mousePosition.x = event.clientX;
                this.mousePosition.y = event.clientY;
                var viewportWidth = document.documentElement.clientWidth;
			    var viewportHeight = document.documentElement.clientHeight;
                this.edgeTop = this.edgeSize;
                this.edgeLeft = this.edgeSize;
                this.edgeBottom = (viewportHeight - this.edgeSize);
                this.edgeRight = (viewportWidth - this.edgeSize);
                this.isInLeftEdge = (this.mousePosition.x < this.edgeLeft);
                this.isInRightEdge = (this.mousePosition.x > this.edgeRight);
                this.isInTopEdge = (this.mousePosition.y < this.edgeTop);
                this.isInBottomEdge = (this.mousePosition.y > this.edgeBottom);
                if (!(this.isInLeftEdge || this.isInRightEdge || this.isInTopEdge || this.isInBottomEdge)) { 
                    return;
                }
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
                this.maxScrollX = ( documentWidth - viewportWidth );
                this.maxScrollY = ( documentHeight - viewportHeight );
                
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
				var maxStep = 10;
 
				// Should we scroll left?
				if ( this.isInLeftEdge && canScrollLeft ) {
					nextScrollX = (nextScrollX - maxStep);
				// Should we scroll right?
				} else if (this.isInRightEdge && canScrollRight) {
					nextScrollX = (nextScrollX + maxStep);
				}
				// Should we scroll up?
				if (this.isInTopEdge && canScrollUp) {
					nextScrollY = (nextScrollY - maxStep);
				// Should we scroll down?
				} else if (this.isInBottomEdge && canScrollDown) {
					nextScrollY = (nextScrollY + maxStep);
				}
 
				// Sanitize invalid maximums. An invalid scroll offset won't break the
				// subsequent .scrollTo() call; however, it will make it harder to
				// determine if the .scrollTo() method should have been called in the
				// first place.
				nextScrollX = Math.max(0, Math.min(this.maxScrollX, nextScrollX));
				nextScrollY = Math.max(0, Math.min(this.maxScrollY, nextScrollY));
 
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