import Vue from 'vue'

// Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'popper.js/dist/umd/popper.js'

// Route List
import router from './routes'

// Store (Vuex)
import store from './store/store'

// Bootstrapper
import './bootstrap.js'

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


import App from './components/App'
// Main Vue instance
const app = new Vue({
    el: '#app',
    components:{
        App
    },
    router,
    store,
});
