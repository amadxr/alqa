<template>
    <div class="row">
        <div class="col-sm-9 full-page-column">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3 full-page-column">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .single-button-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    },
    .full-page-column {
        height: 100vh;
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
