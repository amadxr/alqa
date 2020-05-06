<template>
    <div v-on:mousemove="getMousePosition" class="d-flex justify-content-center align-items-center">
        <h2>Este es el centro</h2>         
    </div>
</template>

<script>
    export default {
        data() {
            return {   
                mousePosition: {
                    x: 0,
                    y: 0,
                }             
            };
        },
        methods: {
            getMousePosition: function (event){
                console.log(event.clientX, event.clientY);
                this.mousePosition.x = event.clientX;
                this.mousePosition.y = event.clientY;
            }
        }
    }
</script>