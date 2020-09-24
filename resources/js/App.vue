<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <a href="#" target="_blank"><img src="data:image/jpeg;base64,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"></a><br>
            <span class="text-secondary">FilmWeb</span>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/home" class="nav-item nav-link">Home</router-link>
                    <router-link to="/films/create" class="nav-item nav-link">Add Film</router-link>
                    <div v-if="!$auth.check()" class="nav-item nav-link">
                        <router-link :to="{ name: 'register' }">Register
                        </router-link>
                    </div>
                    <li v-if="$auth.check()" class="nav-item nav-link">
                        <a href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>
    </div>
</template>


