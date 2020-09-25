<template>
    <div>
        <h3 class="text-center">Add Film</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addFilm">
                    <div class="form-group">
                        <label>Name</label>
                        <input required="required"  type="text" class="form-control" v-model="film.name">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input required="required"  type="text" class="form-control" v-model="film.slug" >
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input required="required"  type="text" class="form-control" v-model="film.description">
                    </div>
                    <div class="form-group">
                        <label>Release Date</label>
                        <input required="required"  type="date" class="form-control" v-model="film.release_date">
                    </div>
                    <div class="form-group">
                        <label>Rating</label>
                        <input required="required"  min="1" max="5" type="number" class="form-control" v-model="film.rating">
                    </div>
                    <div class="form-group">
                        <label>Ticket Price</label>
                        <input required="required"  min="10" max="1000" type="number" class="form-control" v-model="film.ticket_price">
                    </div><div class="form-group">
                        <label>Country</label>
                        <input required="required"  type="text" class="form-control" v-model="film.country">
                    </div>
                    <div class="form-group">
                        <label>Genre</label>
                        <input required="required"  type="text" class="form-control" v-model="film.genre">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input required="required" accept="image/*" type="file" @change="onFileChange">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Film</button>
                </form>
            </div>
        </div>
    </div>
</template>



<script>
    export default {
        data() {
            return {
                film: {},
            }
        },
        methods: {
            /*create new film */
            addFilm() {
                this.axios
                    .post('http://localhost:8000/api/film/add', this.film)
                    .then(response => (
                        this.$router.push({name: 'home'})
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            /*photo upload on change event*/
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            /*save photo for form submission*/
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;
                reader.onload = (e) => {
                    vm.film.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.film.image = '';
            }

        }
    }
</script>