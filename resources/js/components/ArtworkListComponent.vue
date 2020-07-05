<template>
    <div class="jumbotron" v-if="artworks.length === 0">
        <h1 class="display-4">There are no artworks registered yet!</h1>
        <p class="lead">To register an artwork click the button below.</p>
        <button type="button" class="btn btn-dark btn-lg" v-on:click="redirectToCreate">Register artwork!</button>
    </div>
    <div v-else>
        <div class="single-button-container">
            <button type="button" class="btn btn-dark" v-on:click="redirectToCreate">Register artwork</button>
        </div>
        <table class="table table-hover table-striped table-dark table-borderless">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Price</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="artwork in artworks">
                    <td>{{ artwork.name }}</td>
                    <td>{{ artwork.sku }}</td>
                    <td>{{ artwork.origin }}</td>
                    <td>{{ artwork.price }}</td>
                    <td><button type="button" class="btn btn-sm btn-outline-light" v-on:click="redirectToUpdate(artwork.id)">Update</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style>
    .single-button-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }
</style>

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
        }
    }
</script>
