<template>
    <div class="vh-100">
        <wall-component :style="wallStyle"/> 
    </div>
</template>

<script>
    export default {
        data() {
            return {
                wallStyle: {
                    height: '200%',
                    width: '200%'
                }           
            };
        },
      
    }
</script>