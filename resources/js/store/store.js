import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

// Vuex Modules
import auth from './modules/auth.js'
import posts from './modules/posts.js'
import friends from './modules/friends'

const store = new Vuex.Store({
    modules: {
        // ES5 style
        auth: auth,
        // ES6 style (only one property if imported value is same name with property)
        posts,
        friends

    }
})

// Store initialize
export default store
