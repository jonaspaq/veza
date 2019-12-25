import Vue from 'vue'

// Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'popper.js/dist/umd/popper.js'

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
