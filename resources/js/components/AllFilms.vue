<template>
    <div>
        <h3 class="text-center">All Films</h3><br/>
         <!--film grid get all films on page-->
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
            <!--loop through the film array-->
            <tr v-for="film in films" :key="film.id">
                <td>{{ film.id }}</td>
                <td>{{ film.name }}</td>
                <td>{{ film.description }}</td>
                <td>{{ film.release_date }}</td>
                <td>{{ film.rating }}</td>
                <td>  <img v-bind:src="film.photo" width="100" height="120"/></td>
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
            /*load all films*/
            this.axios
                .get('http://localhost:8000/api/films')
                .then(response => {
                    this.films = response.data;
                });
        },
        methods: {
            /*delete all films*/
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