import AllFilms from './components/AllFilms.vue';
import AddFilm from './components/AddFilm.vue';
import ShowFilm from './components/ShowFilm.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';





export const routes = [
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
        component: Register
    },{
        path: '/login',
        name: 'login',
        component: Login
    }

];


