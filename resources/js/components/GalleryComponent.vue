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
                    height: '150%',
                    width: '150%'
                }           
            };
        },
      
    }
</script>