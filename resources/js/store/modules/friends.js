
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
        }
    },
    getters: {
        friendSentRequests: state => state.friendSentRequests
    }
}