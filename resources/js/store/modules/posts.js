import axios from 'axios'

export default {
    namespaced:true,

    state:{
        posts:[]
    },
    mutations:{
        SET_POSTS_DATA: function(state, data){
            state.posts = data
        },
        APPEND_TO_POSTS_DATA(state, data){

            // Checks if posts is empty
            // If empty, it uses unshift method, if not it uses push method
            if(state.posts!==''){
                state.posts.unshift(data)
            }
            else{
                state.posts.push(data)
            }
        },
        REMOVE_ITEM_FROM_POSTS_DATA(state, post){
            state.posts.splice(post, 1)
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
                    commit('SET_POSTS_DATA', response.data)
                    resolve(response)
                })
                .catch((err)=>{
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
                    commit('APPEND_TO_POSTS_DATA', response.data.data)
                    resolve(response)
                })
                .catch((err)=>{
                    reject(err)
                })

            });
        },
        deletePost({commit}, post){
            commit('REMOVE_ITEM_FROM_POSTS_DATA', post)
        }
    },
    getters:{
        posts:(state)=>{
            return state.posts
        }
    }
}