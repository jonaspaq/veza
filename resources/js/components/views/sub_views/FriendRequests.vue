<template>
    <div class="container-fluid py-2 px-3">

        <div class="row no-gutters">
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

export default {
    name: 'FriendRequests',
    components: { FriendRequestItem },

    created(){
        this.$store.dispatch('friends/fetchFriendReceivedRequests')
        .then(res =>{
            // console.table(res.data.data)
        })
    },

    computed:{
        friendRequests(){
            return this.$store.getters['friends/friendReceivedRequests']
        }
    }
}
</script>
