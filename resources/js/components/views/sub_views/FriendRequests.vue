<template>
    <div class="container-fluid py-2 px-3">

        <div class="row no-gutters">
            <div v-if="loading&&Object.entries(friendRequests)==0" class="col-12 font-weight-bold">
                <PleaseWaitLoader class="justify-content-center py-5" />
            </div>
            <div v-for="friend in friendRequests.data" :key="friend.id" class="col-12 col-md-6 mb-2">
                <div class="mr-md-2">
                    <FriendRequestItem :friend="friend" />
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import FriendRequestItem from '../../subcomponents/friendpage/FriendRequestItem'
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name: 'FriendRequests',
    components: { FriendRequestItem, PleaseWaitLoader },

    data(){
        return {
            loading: false
        }
    },

    created(){
        this.fetchFriendRequests()
    },

    methods:{
        fetchFriendRequests(){
            this.loading = true
            this.$store.dispatch('friends/fetchFriendReceivedRequests')
            .then(res =>{
                this.loading = false
            })
        }
    },

    computed:{
        friendRequests(){
            return this.$store.getters['friends/friendReceivedRequests']
        }
    }
}
</script>
