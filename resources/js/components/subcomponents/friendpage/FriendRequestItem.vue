<template>
    <div class="d-flex align-items-center shadow-sm py-2 friendItem bg-white px-2">
        <div class="friendItemImg centerImage mr-1">
            <img src="/images/user.png" :alt="friend.sender.name">
        </div>
        <router-link :to="{name:'userProfile', query:{user: friend.sender.id}}" class="senderName anchorColor">{{ friend.sender.name }}</router-link>

        <button v-if="!warn&&!loading" class="emptyBtn ml-auto" @click="acceptRequest(friend)">
            <i class="fas fa-user-plus"></i>
        </button>
        <button v-if="!warn&&!loading" class="emptyBtn ml-1 mr-1" @click="warnDecline">
            <i class="fas fa-user-times"></i>
        </button>

        <button v-if="warn&&!loading" class="emptyBtn animated fadeIn ml-auto mr-2" @click="declineRequest(friend)">
            <i class="fas fa-user-times"></i>
        </button>
        <button v-if="warn&&!loading" class="emptyBtn animated fadeIn mr-1" @click="cancelDecline">
            <i class="fas fa-times"></i>
        </button>

        <PleaseWaitLoader v-if="loading" class="ml-auto mr-1" />

    </div>
</template>

<script>
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name: 'FriendRequestItem',
    components: { PleaseWaitLoader },
    props: ['friend'],

    data(){
        return {
            warn: false,
            loading: false
        }
    },

    methods:{
        acceptRequest(data){
            this.loading = true
            this.$store.dispatch('friends/acceptFriendRequest', data)
            .then(response =>{
                this.loading = false
            })
        },
        warnDecline(){
            this.warn = true
        },
        declineRequest(data){
            this.loading = true
            this.$store.dispatch('friends/deleteFriendRequest', data)
            .then(response =>{
                this.loading = false
            })
        },
        cancelDecline(){
            this.warn = false
        }
    }
}
</script>

<style lang="scss" scoped>
.senderName{
    font-weight: 600;
    font-size: 14px;
    max-width: 200px;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;

    @media(min-width: 768px){
        width: 250px;
    }
}

.friendItem{
    border-radius: 4px;
    
    &Img{
        border-radius: 50px;
        width: 30px;
        height: 30px;
        box-shadow: 0 0 0 .2px rgb(211, 211, 211);
    }

    .fa-user-plus{
        color: #28B463;
    }
    .fa-user-times{
        color: #EC7063;
    }
    .fa-times{
        color: #ebeb6a;
    }
}
</style>