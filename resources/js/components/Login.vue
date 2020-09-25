<template>
    <div>
        <h2>Please Login Now</h2>
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <!--USER LOGIN-->
        <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
</template>


<script>
    export default {
        data(){
            return {
                email: null,
                password: null,
                error: false,
                msg  : '',
                success: false,
                response: []
            }
        },
        methods: {
            /*user login*/
            login(){
                /*get last referral url to redirect to same page after login*/
                let url = localStorage.getItem("slug");
                var app = this
                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password
                    },
                    success: function (data) {
                        app.success = true;
                        app.response= data;
                        console.log('app.response' , app.response)
                    },
                    error: function(e) {
                        console.log(e);
                    },
                    rememberMe: true,
                    redirect: '/film/'+url,
                    fetchUser: true,
                }).then(resp=>{
                }).catch(error=>{
                    app.error = true
                    console.log('error 22' , error);

                });
            },
        }
    }
</script>