<template>
    <div class="container-fluid bg-white shadow-sm rounded py-2 px-1">

        <div class="row no-gutters">
            <div class="col-12 mb-2" v-for="friend in sentRequests.data" :key="friend.id">
                <div class="d-flex align-items-center py-2 friendItem">
                    <img src="/images/user.png" class="friendItemImg mr-1" :alt="friend.receiver.name">
                    <span>{{ friend.receiver.name }}</span>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    name: 'SentFriendRequests',

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

<style lang="scss" scoped>
.friendItem{
    border-radius: 4px;
    // box-shadow: 0 0 2px 0.2px rgb(216, 216, 216);
    
    &Img{
        border-radius: 50px;
        width: 40px;
        height: 40px;
        // box-shadow: 0 0 0 0.3px gray;
        border: 1px solid rgb(211, 211, 211);
    }
}
</style>