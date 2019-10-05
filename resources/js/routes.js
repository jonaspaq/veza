import Login from './components/views/Login'
import Register from './components/views/Register'
import Home from './components/views/Home'

export default [
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
        path: '/home',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: true
        }
    }
]