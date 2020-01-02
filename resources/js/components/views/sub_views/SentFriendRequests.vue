<template>
    <div class="container-fluid py-2 px-3">

        <div class="row no-gutters">
            <div v-for="friend in sentRequests.data" :key="friend.id" class="col-12 col-md-6 mb-2">
                <div class="mr-md-2">
                    <SentFriendRequestItem :friend="friend" />
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import SentFriendRequestItem from '../../subcomponents/SentFriendRequestItem'

export default {
    name: 'SentFriendRequests',
    components: { SentFriendRequestItem },

    created(){
        this.$store.dispatch('friends/fetchSentRequests')
    },

    computed:{
        sentRequests(){
            return this.$store.getters['friends/friendSentRequests']
        }
    }
}
</script>