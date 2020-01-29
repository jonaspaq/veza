<template>
    <div class="container-fluid py-2 px-3">

        <div class="row no-gutters">
            <div v-if="loading&&Object.entries(friends)==0" class="col-12 font-weight-bold">
                <PleaseWaitLoader class="justify-content-center py-5" />
            </div>
            <div v-for="friend in friends.data" :key="friend.id" class="col-12 col-md-6 mb-2">
                <div class="mr-md-2">
                    <FriendItem :friend="friend" />
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import FriendItem from '../../subcomponents/friendpage/FriendItem'
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name: 'FriendList',
    components:{ FriendItem, PleaseWaitLoader },

    data(){
        return {
            loading: false
        }
    },

    created(){
        this.fetchFriends()
    },

    methods:{
        fetchFriends(){
            this.loading = true
            this.$store.dispatch('friends/fetchFriends')
            .then(response=>{
                this.loading = false
            })
        }
    },

    computed:{
        friends(){
            return this.$store.getters['friends/friends']
        }
    }
}
</script>
