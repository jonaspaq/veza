// Route List (Vue-router)
import router from './routes'
import store from '../store/store'

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