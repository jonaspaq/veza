import axios from 'axios'

export default {
    namespaced:true,

    state:{
        posts:[],
        toDeletePost:'',
        toEditPost:''
    },
    mutations:{
        SET_POSTS_DATA: function(state, data){
            state.posts = data
        },
        APPEND_TO_POSTS_DATA(state, data){
            // Checks if posts is empty
            // If empty, it uses unshift method, if not it uses push method
            (state.posts) ? state.posts.unshift(data) : state.posts.push(data)
        },
        REMOVE_ITEM_FROM_POSTS_DATA(state, post){  
            state.posts.splice(state.posts.indexOf(post), 1)
        },
        SET_TO_DELETE_POST(state, data){
            state.toDeletePost = data;
        },
        UNSET_TO_DELETE_POST(state){
            state.toDeletePost = null;
        },
        SET_TO_EDIT_POST(state, data){
            state.toEditPost = null
            state.toEditPost = Object.assign({}, data);
        },
        UNSET_TO_EDIT_POST(state){
            state.toEditPost = '';
        },
    },
    actions:{
        getAllPost({commit, rootGetters}){
            return new Promise((resolve,reject)=>{
                axios.get('/api/post', {
                    headers:{
                        Accept: 'application/json',
                        Authorization:'Bearer '+rootGetters['auth/token']
                    }
                })
                .then((response)=>{
                    // Checks if it retrieved atleast 1 post
                    // If yes it sets the posts state, if not it sets empty array
                    (response.status==200) ? commit('SET_POSTS_DATA', response.data) : commit('SET_POSTS_DATA', [])
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
        toDeletePost({commit}, data){
            commit('SET_TO_DELETE_POST', data)
        },
        deletePost({commit, getters, rootGetters}){
            return new Promise((resolve, reject)=>{
                axios({
                    headers:{
                        Accept: 'application/json',
                        Authorization:'Bearer '+rootGetters['auth/token'],
                    },
                    method:'DELETE',
                    url:'/api/post/'+getters.toDeletePost.id,
                })
                .then((response)=>{
                    resolve(response)
                    commit('REMOVE_ITEM_FROM_POSTS_DATA', getters.toDeletePost)
                })
                .catch((err)=>{
                    reject(err)
                })
            })
        },
        toEditPost({commit}, data){
            commit('SET_TO_EDIT_POST', data)
        },
        editPost({commit, getters, rootGetters}, data){
            return new Promise((resolve, reject) => {
                axios({
                    headers:{
                        Accept: 'application/json',
                        Authorization:'Bearer '+rootGetters['auth/token'],
                    },
                    method:'PATCH',
                    url:'/api/post/'+getters.toEditPost.id,
                    data:{
                        id: getters.toEditPost.id,
                        content: getters.toEditPost.content
                    }
                })
                .then((response)=>{
                    resolve(response)
                })
                .catch((err)=>{
                    reject(err)
                })
            })
        }
    },
    getters:{
        posts: (state) => state.posts,
        toDeletePost: (state) => state.toDeletePost,
        toEditPost: (state) => state.toEditPost
    }
}