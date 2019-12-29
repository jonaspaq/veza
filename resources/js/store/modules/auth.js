
export default {
    namespaced: true, 

    state: {
        loginLoading: false,
        loginErrors:'',
        access_token: localStorage.getItem('Session') || '',
        user:'',

    },
    mutations: {
        ENABLE_LOGIN_LOADING(state){
            state.loginLoading = true
        },
        DISABLE_LOGIN_LOADING(state){
            state.loginLoading = false
        },
        SET_ACCESS_TOKEN(state, data){
            state.access_token = data
            localStorage.setItem('Session', data)
        },
        UNSET_ACCESS_TOKEN(state){
            state.access_token = ''
            localStorage.removeItem('Session')
        },
        SET_USER_DETAILS(state, data){
            state.user = data
        },
        UNSET_USER_DETAILS(state){
            state.user = ''
        },
        SET_LOGIN_ERRORS(state, data){
            state.loginErrors = data
        },
        UNSET_LOGIN_ERRORS(state){
            state.loginErrors = ''
        }
    },
    actions: {
        initiateLogin({commit}, data){
            return new Promise((resolve, reject)=>{
                commit('ENABLE_LOGIN_LOADING')

                axios.post('/api/login', data)
                .then((response)=>{
                    commit('SET_ACCESS_TOKEN', response.data.access_token)
                    commit('SET_USER_DETAILS', response.data.user)
                    commit('UNSET_LOGIN_ERRORS')
                    commit('DISABLE_LOGIN_LOADING')
                    resolve(response)
                })
                .catch((err)=>{
                    commit('SET_LOGIN_ERRORS', err.response.data.message)
                    commit('DISABLE_LOGIN_LOADING')
                    reject(err)
                });
            });
        },
        setUserDetails({commit, getters}){
            return new Promise((resolve, reject)=>{
                axios.get('/api/user/authenticatedUserDetails')
                .then((response)=>{
                    commit('SET_USER_DETAILS', response.data)
                    resolve(response)
                })
                .catch((err)=>{
                    reject(err)
                })
            })
        },
        initiateLogout({commit}){
            commit('UNSET_ACCESS_TOKEN')
        }
    },
    
    getters: {
        loginLoading(state){
            return state.loginLoading
        },
        user: function(state){
            return state.user
        },
        token: (state) => {
            return state.access_token
        },
        loginErrors(state){
            return state.loginErrors
        },
        loginStatus(state){
            return (state.user) ? true : false
        }
    }
}