<template>
    <div class="fixed top-0 left-0 z-10 flex flex-col justify-between w-screen h-screen pt-48 pb-32 pl-32 text-5xl bg-white font-alqa-special">
        <button
            @click="closeMenu"
            class="fixed top-0 right-0 w-10 h-10 mt-6 mr-6 rounded-full bg-alqa-charcoal">
        </button>
        <div class="group" v-for="(menuItem, index) in menuItems">
            <span class="text-3xl transition-all duration-300 ease-in-out group-hover:font-bold">
                0{{ index + 1 }}
            </span>
            <span class="inline-block mr-16 origin-left transform scale-x-400 transition-all duration-300 ease-in-out group-hover:scale-x-600 group-hover:mr-28"> _ </span>
            <span>
                <a href="/cart">{{ menuItem }}</a>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                menuItems: [
                    'Nosotros',
                    'Contacto',
                    'Cuadernos de Cultura',
                    'Lista de Deseos',
                    'Agenda tu Visita',
                ],
            };
        },
        methods: {
            closeMenu () {
                this.$emit('close');
            },
        },
    }
</script>
