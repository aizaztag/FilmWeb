<template>
    <div>
        <!--film details-->
        <h3 class="text-center">Film Detail</h3><br/>
        <img  width="100" height="120" v-bind:src="films.photo"/>
        <h3> Movie : {{ films.name }}</h3>
        <h3> Description : {{ films.description }}</h3>
        <h3> Rating : {{ films.rating }}</h3>
        <h3> Release Date : {{ films.release_date }}</h3>
        <!--All Comments on this movie-->
        <h5>User Reviews</h5>
        <ul id="example-1">
            <li v-for="item in comments" :key="item.message">
                {{ item.comment }}
            </li>
        </ul>
        <!--check if user is logged-in to comment -->
        <div v-if="!$auth.check()" class="nav-item nav-link">
            <router-link :to="{ name: 'register' }">Comment on this movie
            </router-link>
        </div>
        <!--comment form-->
        <li v-if="$auth.check()" class="nav-item nav-link">
            <form @submit.prevent="addComment" method="post">
                <div class="form-group">
                    <label>Comment on this movie</label>
                    <input required="required" type="text" class="form-control" v-model="comment">
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
                comments: [],
                isLoggedIN: false,
                comment: '',
                slug: ''
            }
        },
        created() {
            let slug = this.$route.params.slug
            // set slug to redirect on same page
            localStorage.setItem("slug", slug);
            /*loads film model on page load*/
            this.axios
                .get(`http://localhost:8000/api/film/edit/${slug}`)
                .then(response => {
                    this.films = response.data.item;
                    this.isLoggedIN = response.data.login;
                    console.log('response.data', response.data)
                });
            /*load user comments on related to movie*/
            this.axios
                .post(`http://localhost:8000/api/comment/index` ,  { slug: slug }  )
                .then(response => {
                    this.comments = response.data;
                });
        },
        methods: {
            addComment() {
                /*create comment*/
                this.axios
                    .post('http://localhost:8000/api/comment/store', {
                        comment: this.comment,
                        slug: this.$route.params.slug,
                    })
                    .then(response => (
                        //this.$router.push({name: 'home'})
                        this.comments = response.data,
                        this.comment = '',
                        console.log('this.comments ', this.comments)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            deleteFilm(id) {
                /*delete */
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