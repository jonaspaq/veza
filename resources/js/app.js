import Vue from 'vue'

// Route List (Vue-router)
import router from './route/routes'

// Store (Vuex)
import store from './store/store'

// Bootstrapper
import './bootstrap.js'

// Middleware
import './route/middleware'

// Main Vue instance
import App from './components/App'

const app = new Vue({
    components:{ App },
    router,
    store,
    render: h => h(App)
}).$mount('#app');
