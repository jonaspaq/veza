<template>
    <div class="container-fluid py-2 px-3">

        <div class="row no-gutters">
            <div v-if="loading&&Object.entries(sentRequests)==0" class="col-12 font-weight-bold">
                <PleaseWaitLoader class="justify-content-center py-5" />
            </div>
            <div v-for="friend in sentRequests.data" :key="friend.id" class="col-12 col-md-6 mb-2">
                <div class="mr-md-2">
                    <SentFriendRequestItem :friend="friend" />
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import SentFriendRequestItem from '../../subcomponents/friendpage/SentFriendRequestItem'
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name: 'SentFriendRequests',
    components: { SentFriendRequestItem, PleaseWaitLoader },

    data(){
        return {
            loading: false
        }
    },

    created(){
        this.fetchSentRequests()
    },

    methods:{
        fetchSentRequests(){
            this.loading = true
            this.$store.dispatch('friends/fetchSentRequests')
            .then(res=>{
                this.loading = false
            })
        }
    },

    computed:{
        sentRequests(){
            return this.$store.getters['friends/friendSentRequests']
        }
    }
}
</script>