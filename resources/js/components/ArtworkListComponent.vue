<template>
    <div class="relative flex flex-col flex-1 w-full p-20 space-y-2">
        <button class="absolute top-0 right-0 flex items-center justify-center w-12 h-12 m-5 text-3xl border-2 border-black rounded-full bg-adobe"
            type="button" v-on:click="redirectToCreate">
            +
        </button>
        <div class="p-5 bg-gray-200 rounded-lg inline-grid grid-cols-3 gap-x-4" v-for="artwork in artworks">
            <div class="flex flex-col space-y-1">
                <p class="text-lg">{{ artwork.name }}</p>
                <p class="text-sm">{{ artwork.origin }}</p>
            </div>
            <div class="flex flex-col items-center space-y-1">
                <p>{{ artwork.sku}}</p>
                <p>{{ artwork.price }}</p>
            </div>
            <div class="flex flex-row justify-end space-x-2">
                <button type="button" class="px-4 py-1 text-xs border-2 border-black rounded-lg" v-on:click="redirectToUpdate(artwork.id)">Update</button>
                <button type="button" class="px-4 text-xs border-2 border-black rounded-lg" v-on:click="deleteArtwork(artwork.id)">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created () {
            this.fetchArtworks();
        },
        data () {
            return {
                artworks: [],
            };
        },
        methods: {
            fetchArtworks () {
                axios
                    .get(process.env.MIX_APP_URL + 'api/artworks')
                    .then(response => {
                        this.setArtworks(response);
                    });
            },

            setArtworks (response) {
                let artworks = response.data.data.artworks;

                if (artworks !== null) {
                    this.artworks = artworks;
                }
            },

            redirectToCreate () {
                window.location.href = "artwork/create";
            },

            redirectToUpdate (id) {
                window.location.href = "artwork/show/" + id;
            },

            deleteArtwork (id) {
                axios
                    .delete(process.env.MIX_APP_URL + 'api/artworks/' + id)
                    .then(() => {
                        window.location.href = "artwork";
                    });
            },
        }
    }
</script>
