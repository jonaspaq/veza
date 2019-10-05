import axios from 'axios'

export default {
    namespaced:true,

    state:{
        posts:''
    },
    mutations:{
        SET_POSTS_DATA: function(state, data){
            state.posts = data
        },
        APPEND_TO_POSTS_DATA(state, data){
            state.posts.unshift(data)
        }
    },
    actions:{
        getAllPost({commit}, token){
            return new Promise((resolve,reject)=>{

                axios.get('/api/post', {
                    headers:{
                        Accept: 'application/json',
                        Authorization:'Bearer '+token
                    }
                })
                .then((response)=>{
                    // console.log(response.data)
                    commit('SET_POSTS_DATA', response.data)
                    resolve(response)
                })
                .catch((err)=>{
                    // console.log(err.response.data.message)
                    reject(err)
                })
            });
        },
        addPost({commit}, {content,token}){
            return new Promise((resolve, reject)=>{ 
                axios({
                    headers:{
                        Accept: 'application/json',
                        Authorization:'Bearer '+token,
                    },
                    method:'POST',
                    url:'/api/post',
                    data:{
                        content // ES6 syntax
                    }
                })
                .then((response)=>{
                    // console.log(response.data.data)
                    commit('APPEND_TO_POSTS_DATA', response.data.data)
                    resolve(response)
                })
                .catch((err)=>{
                    reject(err)
                })

            });
        }
    },
    getters:{
        posts:(state)=>{
            return state.posts
        }
    }
}