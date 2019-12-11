import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

// Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'popper.js/dist/umd/popper.js'

Vue.use(VueRouter)
Vue.use(Vuex)

import App from './components/App'

// Route List
import routes from './routes'

// Bootstrapper
import './bootstrap.js'

// Vuex Modules
import auth from './store/modules/auth.js'
import posts from './store/modules/posts.js'

// Store initialize
export const store = new Vuex.Store({
    modules: {
        auth: auth,
        posts: posts
    }
});

// Router Initialize
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// Middleware
router.beforeEach((to, from, next) => {
    // Checks if route needs authentication
    if(to.meta.requiresAuth == true){
        if(store.getters['auth/token']!==''){
            // Checks if user details is set and if token is revoked
            // If token is revoked redirect to login page
            if(store.getters['auth/user'].id!=null){
                next()
            }else{
                store.dispatch('auth/setUserDetails')
                .then(response =>{
                    next()
                })
                .catch(err => {
                    localStorage.removeItem('Session')
                    location.replace("/user/login?auth=false")
                })
            }
        }
        else{
            next({name:'login'})
        }
    }
    // Checks if route is for guest only, redirect to home if authenticated
    else if(to.meta.guestOnly == true){
        if(store.getters['auth/token']!==''){
            next({name:'home'})
        }
        else{
            next()
        }
    }
    else{
        next()
    }
});

// Main Vue instance
const app = new Vue({
    el: '#app',
    components:{
        App
    },
    router,
    store,
});
