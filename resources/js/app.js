require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
/*vue components */
import AllFilms from './components/AllFilms.vue';
import AddFilm from './components/AddFilm.vue';
import ShowFilm from './components/ShowFilm.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';

/*websanova setup for frontend  authentication with jwt token based auth*/
import auth            from '@websanova/vue-auth';
import authBasic       from '@websanova/vue-auth/dist/drivers/auth/basic.esm.js';
import routerVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
import http from '@websanova/vue-auth/drivers/http/axios.1.x';

/*VueRouter router*/
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'home',
            path: '/home',
            component: AllFilms
        },
        {
            name: 'home',
            path: '/films',
            component: AllFilms
        },
        {
            name: 'add',
            path: '/films/create',
            component: AddFilm
        },
        {
            name: 'show',
            path: '/film/:slug',
            component: ShowFilm
        }
        ,{
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },{
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        }
    ]

});
Vue.router = router;
/*websanova configuration*/
Vue.use(auth, {
    auth: authBasic,
    http: http,
    router: routerVueRouter,

});
/*vue loaded*/
App.router = Vue.router
new Vue(App).$mount('#app');