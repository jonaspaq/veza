import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

// Vuex Modules
import auth from './modules/auth.js'
import posts from './modules/posts.js'

const store = new Vuex.Store({
    modules: {
        auth: auth,
        posts: posts
    }
})

// Store initialize
export default store 