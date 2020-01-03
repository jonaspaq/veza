<template>
    <div class="d-flex align-items-center shadow-sm py-2 friendItem bg-white px-2">
        <div class="friendItemImg centerImage mr-1">
            <img src="/images/user.png" :alt="friend.receiver.name">
        </div>
        <router-link to="/1" class="friendRecieverName anchorColor">{{ friend.receiver.name }}</router-link>

        <!-- <button class="emptyBtn ml-auto mr-2">
            <i class="fas fa-user-plus"></i>
        </button> -->
        <button v-if="!warn" class="emptyBtn ml-auto mr-1" @click="warnDeletion">
            <i class="fas fa-user-times"></i>
        </button>

        <button v-if="warn&&!loading" class="emptyBtn animated fadeIn ml-auto mr-2" @click="deleteRequest(friend)">
            <i class="fas fa-user-times"></i>
        </button>
        <button v-if="warn&&!loading" class="emptyBtn animated fadeIn mr-1" @click="warnDeletion">
            <i class="fas fa-times"></i>
        </button>

        <PleaseWaitLoader v-if="loading" class="ml-auto mr-1" />

    </div>
</template>

<script>
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name: 'SentFriendRequestItem',
    props: ['friend'],
    components: { PleaseWaitLoader },

    data(){
        return {
            warn: false,
            loading: false,
            retryRequestCount: 0
        }
    },

    methods:{
        warnDeletion(){
            this.warn = !this.warn
        },
        deleteRequest(data){
            this.loading = true
            this.$store.dispatch('friends/deleteSentRequest', data)
            .catch(err =>{
                setTimeout(() =>{
                    if(err.message="Network Error"&&this.retryRequestCount<=5){
                        this.retryRequestCount++    
                        console.log(this.retryRequestCount)
                        this.deleteRequest(data)
                    }else{
                        alert('Please check your network connection')
                    }
                }, 2000)
            })
        }
    },
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