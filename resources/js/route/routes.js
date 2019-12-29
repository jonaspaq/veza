import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Components that should always be loaded
import Home from '../components/views/Home'

// Components that should be loaded only when needed
const Login =  () => import('../components/views/Login');
const Register =  () => import('../components/views/Register');
const EditProfile =  () => import('../components/views/EditProfile');

// Router Initialize
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'landpage',
            component: Login,
            meta:{
                guestOnly: true
            }
        },
        {
            path: '/user/login',
            name: 'login',
            component: Login,
            meta:{
                guestOnly: true
            }
        },
        {
            path: '/user/register',
            name: 'register',
            component: Register,
            meta:{
                guestOnly: true
            }
        },
        {
            path: '/user/edit/profile',
            name: 'editProfile',
            component: EditProfile,
            meta:{
                requiresAuth: true
            }
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
            meta: {
                requiresAuth: true
            }
        }
    ]
});

export default router