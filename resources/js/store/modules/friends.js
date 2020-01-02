
export default {
    namespaced: true,

    state: {
        friends: [],
        friendReceivedRequests: [],
        friendSentRequests: []
    },
    mutations:{
        SET_SENT_REQUESTS(state, data){
            state.friendSentRequests = data
        },
        REMOVE_SENT_REQUEST(state, toDelete){
            state.friendSentRequests.data.splice(state.friendSentRequests.data.indexOf(toDelete), 1)
        }
    },
    actions:{
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
        friendSentRequests: state => state.friendSentRequests
    }
}