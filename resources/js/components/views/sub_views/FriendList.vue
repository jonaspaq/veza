<template>
    <div class="container-fluid py-2 px-3">

        <div class="row no-gutters">
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

export default {
    name: 'FriendList',
    components:{ FriendItem },

    created(){
        this.fetchFriends()
    },

    methods:{
        fetchFriends(){
            this.$store.dispatch('friends/fetchFriends')
        }
    },

    computed:{
        friends(){
            return this.$store.getters['friends/friends']
        }
    }
}
</script>
