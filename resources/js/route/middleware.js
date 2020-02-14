// Route List (Vue-router)
import router from './routes'
import store from '../store/store'

router.beforeEach((to, from, next) => {
  // Checks if route needs authentication
  if(to.meta.requiresAuth == true){
      // Checks if token is empty
      if(store.getters['auth/token']!=='' || store.getters['auth/token']!==null){
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
                  store.dispatch('auth/initiateLogout')
                  router.replace({name: 'login', query: {auth: false, authExpired: true} })
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