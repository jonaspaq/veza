<template>
    <div class="media align-items-center pb-3 pt-2">
        <div class="border rounded-circle" style="height:40px; width:40px;">
        <img src="/images/user.png" width="100%">
        </div>
        <div class="media-body pl-2">
            <div class="row">
                <div class="col-10">
                    <span>{{ friend.name }}</span>
                </div>
                <div class="col-1">
                    <span>
                        <!-- <i class="fas fa-trash"></i> -->
                        <img class="fa-trash" src="images/garbage.png" alt="marketplace" width="19px" height="19px">
                    </span>
                </div>
                <div class="col-12">
                    <a v-if="!requestStatus" href="javascript:;" @click="addFriend(friend.id)" class="anchorColor"><small>Add Friend</small></a>
                    <span v-if="requestStatus" class="anchorColor"><small class="rotateIn animated">Request sent <i class="fas fa-check"></i></small></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'FriendItem',
    props: ['friend'],

    data: () => ({
        requestStatus: false
    }),

    methods: {
        addFriend(id){
            axios({
                headers:{
                    Accept: 'application/json',
                    Authorization: 'Bearer '+this.$store.getters['auth/token']
                },
                method: 'POST',
                url: '/api/addFriend/'+id
            })
            .then( response => {
                console.log(response.data)
                this.requestStatus = true
            })
            .catch( err => {
                console.log(err)
            })
        }
    }
}
</script>

<style scoped>
.fa-trash:hover{
    cursor: pointer;

    transform-origin: top center;
    animation-name: swing;
    animation-duration: 0.4s;
}
</style>
