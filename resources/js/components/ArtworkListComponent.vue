<template>
    <div class="jumbotron" v-if="artworks.length === 0">
        <h1 class="display-4">There are no artworks registered yet!</h1>
        <p class="lead">To register an artwork click the button below.</p>
        <a class="btn btn-dark btn-lg" href="create" role="button">Register artwork!</a>
    </div>
    <div v-else>
        <a class="btn btn-dark" href="create" role="button">Register new artwork</a>
        <table class="table table-hover table-striped table-dark">
            <thead class="thead-light">
                <tr>
                    <th scope="col">SKU</th>
                    <th scope="col">Name</th>
                    <th scope="col">Origin</th>
                </tr>
            </thead>
        </table>
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
            }
        }
    }
</script>
