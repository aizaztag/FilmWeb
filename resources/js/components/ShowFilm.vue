<template>
    <div>

        <h3 class="text-center">Film Detail</h3><br/>
            <img v-bind:src="films.photo" />
            <h3> Movie : {{ films.name }}</h3>
            <h3> Description : {{ films.description }}</h3>
            <h3> Rating : {{ films.rating }}</h3>
            <h3> Release Date : {{ films.release_date }}</h3>


        <div v-if="!$auth.check()" class="nav-item nav-link">
            <router-link :to="{ name: 'register' }">Comment on this movie
            </router-link>
        </div>
        <li v-if="$auth.check()" class="nav-item nav-link">
            <form @submit.prevent="addComment" method="post">
                <div class="form-group">
                    <label>Comment on this movie</label>
                    <input required="required"  type="text" class="form-control" v-model="comment">
                </div>
                <button type="submit">Submit</button>
            </form>

        </li>

        <p></p>
    </div>





</template>


<script>
    export default {
        data() {
            return {
                films: [],
                isLoggedIN : false,
                comment:'',
                slug : ''
            }
        },
        created() {

            let slug =  this.$route.params.slug
            localStorage.setItem("slug", slug);
            this.axios
                .get(`http://localhost:8000/api/film/edit/${slug}`)
                .then(response => {
                    this.films = response.data.item;
                    this.isLoggedIN = response.data.login;
                    console.log('response.data' , response.data)

                });

            //console.log('this.films' , this.films)
        },
        methods: {

            addComment() {

                this.axios
                    .post('http://localhost:8000/api/film/comment', {
                     comment: this.comment,
                     slug: this.$route.params.slug,
                    })
                    .then(response => (
                        this.$router.push({name: 'home'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },

            greet : function () {
                this.axios
                    .get(`http://localhost:8000/login`)
                    .then(response => {


                    });
            } ,

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