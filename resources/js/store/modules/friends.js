
export default {
    namespaced: true,

    state: {
        friends: [],
        friendReceivedRequests: [],
        friendRecievedRequestCount: '',
        friendSentRequests: []
    },
    mutations:{
        SET_FRIENDS(state, data){
            state.friends = data
        },
        REMOVE_FRIEND(state, data){
            state.friends.data.splice(state.friends.data.indexOf(data), 1)
        },
        REMOVE_FRIEND_REQUEST(state, data){
            state.friendReceivedRequests.data.splice(state.friendReceivedRequests.data.indexOf(data), 1)
        },
        SET_RECIEVED_REQUEST(state, data){
            state.friendReceivedRequests = data
        },
        SET_FRIEND_REQUEST_COUNT(state, data){
            state.friendRecievedRequestCount = data
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
            return new Promise((resolve, reject) =>{
                axios.get('/api/friends/received-requests')
                .then(response =>{
                    resolve(response)
                    commit('SET_RECIEVED_REQUEST', response.data)
                })
                .catch(err =>{
                    reject(err)
                })
            })
        },
        fetchFriendReceivedRequestCount({commit}){
            return new Promise((resolve, reject) =>{
                axios.get('/api/friends/request-count')
                .then(res => {
                    resolve(res)
                    commit('SET_FRIEND_REQUEST_COUNT', res.data)
                })
                .catch(err => {
                    reject(err)
                })
            })
        },
        acceptFriendRequest({commit}, friendToBeAccepted){
            return new Promise((resolve, reject) =>{
                axios.put('/api/friend/any', {id: friendToBeAccepted.id})
                .then(response =>{
                    resolve(response)
                    commit('REMOVE_FRIEND_REQUEST', friendToBeAccepted)
                })
                .catch(err =>{
                    reject(err)
                })
            })
        },
        deleteFriendRequest({commit}, data){
            return new Promise((resolve, reject) =>{
                axios.delete('/api/friend/' + data.id)
                .then( response =>{
                    resolve(response)
                    commit('REMOVE_FRIEND_REQUEST', data)
                })
                .catch(err =>{
                    reject(err)
                })
            })
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
        friendRecievedRequestCount: state => state.friendRecievedRequestCount,
        friendSentRequests: state => state.friendSentRequests
    }
}