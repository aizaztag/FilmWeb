<template>
    <div>
        <h3 class="text-center">All Films</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Release Date</th>
                <th>Raring</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="film in films" :key="film.id">
                <td>{{ film.id }}</td>
                <td>{{ film.name }}</td>
                <td>{{ film.description }}</td>
                <td>{{ film.release_date }}</td>
                <td>{{ film.rating }}</td>
                <td>  <img v-bind:src="film.photo" /></td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'show', params: { slug: film.slug }}" class="btn btn-primary">Detail
                        </router-link>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                films: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/films')
                .then(response => {
                    this.films = response.data;
                });
        },
        methods: {
            deleteFilm(id) {
                this.axios
                    .delete(`http://localhost:8000/api/film/delete/${id}`)
                    .then(response => {
                        let i = this.films.map(item => item.id).indexOf(id); // find index of your object
                        this.films.splice(i, 1)
                    });
            }
        }
    }
</script>