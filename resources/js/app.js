import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

// Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'popper.js/dist/umd/popper'

Vue.use(VueRouter)
Vue.use(Vuex)

import App from './components/App'

// Route List
import routes from './routes'

// Vuex Modules
import auth from './store/modules/auth.js'
import posts from './store/modules/posts.js'

const store = new Vuex.Store({
    modules: {
        auth: auth,
        posts: posts
    }
});

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// Middleware
router.beforeEach((to, from, next) => {
    // Checks if route needs authentication
    if(to.meta.requiresAuth == true){
        if(store.getters['auth/token']!='' && store.getters['auth/user']!=null){
            next()
        }
        else{
            next({name:'login'})
        }
    }
    // Checks if route is for guest only, redirect to home if authenticated
    else if(to.meta.guestOnly == true){
        if(store.getters['auth/token']!='' && store.getters['auth/user']!=null){
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
    store
});
