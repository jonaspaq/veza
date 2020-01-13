
export default {
    namespaced: true,

    state: {
        friends: [],
        friendReceivedRequests: [],
        friendSentRequests: []
    },
    mutations:{
        SET_FRIENDS(state, data){
            state.friends = data
        },
        REMOVE_FRIEND(state, data){
            state.friends.data.splice(state.friends.data.indexOf(data), 1)
        },
        SET_SENT_REQUESTS(state, data){
            state.friendSentRequests = data
        },
        REMOVE_SENT_REQUEST(state, toDelete){
            state.friendSentRequests.data.splice(state.friendSentRequests.data.indexOf(toDelete), 1)
        }
    },
    actions:{
        fetchFriends({commit}){
            return new Promise((resolve, reject) =>{
                axios.get('/api/friend')
                .then(res =>{
                    resolve(res)
                    commit('SET_FRIENDS', res.data)
                })
                .catch(err =>{
                    reject(err)
                })
            })
        },
        deleteFriend({commit}, data){
            return new Promise((resolve, reject) =>{
                axios.delete('/api/friend/' + data.id)
                .then( response =>{
                    resolve(response)
                    commit('REMOVE_FRIEND', data)
                })
                .catch(err =>{
                    reject(err)
                })
            })
        },
        fetchFriendReceivedRequests({commit}){
            return new Promise((resolve, reject =>{
                axios.get('/api/friends/received-requests')
                .then(response =>{
                    resolve(response)
                    commit('SET_RECIEVED_REQUEST', response.data)
                })
                .catch(err =>{
                    reject(err)
                })
            }))
        },
        fetchSentRequests({commit}){
            return new Promise( (resolve, reject) => {
                axios.get('/api/friends/sent-requests')
                .then(response => {
                    commit('SET_SENT_REQUESTS', response.data)
                })
                .catch(err => {
                    reject(err)
                })
            })
        },
        deleteSentRequest({commit}, data){
            return new Promise((resolve, reject) =>{
                axios.delete('/api/friend/'+data.id)
                .then(response =>{
                    resolve(response)
                    commit('REMOVE_SENT_REQUEST', data)
                })
                .catch(err =>{
                    reject(err)
                })
            })
        }
    },
    getters: {
        friends: state => state.friends,
        friendReceivedRequests: state => state.friendReceivedRequests,
        friendSentRequests: state => state.friendSentRequests
    }
}