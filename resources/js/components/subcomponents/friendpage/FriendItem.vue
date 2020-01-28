<template>
    <div class="d-flex align-items-center shadow-sm py-2 friendItem bg-white px-2">
        <div class="friendItemImg centerImage mr-1">
            <img src="/images/user.png" :alt="friendData.name">
        </div>
        <router-link :to="{name:'userProfile', query : {user: friendData.id}}" class="friendRecieverName anchorColor">{{ friendData.name }}</router-link>
        <div v-if="!loading" class="dropdown dropleft ml-auto">
            <button class="emptyBtn mr-1 px-1" type="button" id="friendOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu fadeIn animated" aria-labelledby="friendOptions">
                <router-link :to="{name:'userProfile', query : {user: friendData.id}}" class="dropdown-item">View Profile</router-link>
                <router-link :to="{name:'message', query : {user: friendData.id}}" class="dropdown-item">Send Message</router-link>
                <div class="dropdown-divider"></div>
                <button class="emptyBtn dropdown-item"> Block </button>
                <button class="emptyBtn dropdown-item" @click="unfriend(friend)"> Unfriend </button>
            </div>
        </div>

        <PleaseWaitLoader v-if="loading" class="ml-auto" />

    </div>
</template>

<script>
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name: 'FriendItem',
    components: { PleaseWaitLoader },
    props: ['friend'],

    data(){
        return {
            loading: false
        }
    },

    methods:{
        unfriend(friend){
            this.loading = true
            
            this.$store.dispatch('friends/deleteFriend', friend)
        }
    },

    computed:{
        friendData(){
            // Get the friend data according to the id
            if (this.friend.sender.id == this.$store.getters['auth/user'].id)
                return this.friend.receiver
            return this.friend.sender
        }
    }

}
</script>

<style lang="scss" scoped>
.friendRecieverName{
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