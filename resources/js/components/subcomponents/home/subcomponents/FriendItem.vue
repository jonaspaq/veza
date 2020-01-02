<template>
    <div class="media align-items-center pb-3 pt-2" ref="media">
        <div class="rounded-circle centerImage" style="height:40px; width:40px;">
            <img src="/images/user.png">
        </div>
        <div class="media-body pl-2">
            <div class="row">
                <div class="col-10">
                    <span>{{ friend.name }}</span>
                </div>
                <div class="col-1">
                    <span>
                        <!-- <i class="fas fa-trash"></i> -->
                        <img @click="addAnimationRemove(friend)" class="fa-trash" src="images/garbage.png" alt="marketplace" width="19px" height="19px">
                    </span>
                </div>
                <div class="col-12">
                    <a v-if="!requestStatus" href="javascript:;" @click="addFriend(friend)" class="anchorColor"><small>Add Friend</small></a>
                    <span v-if="requestStatus" class="anchorColor"><small class="fadeIn animated">Request sent <i class="fas fa-check"></i></small></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FriendItem',
    props: ['friend'],

    data: () => ({
        requestStatus: false
    }),
    
    methods: {
        addFriend(friend){
            axios.post('/api/friend', {id: friend.id})
            .then( response => {
                this.requestStatus = true
                setTimeout(e =>{
                    this.$emit('removeSuggestion', friend)
                }, 2000)
            })
            .catch( err => {
                console.log(err)
            })
        },
        addAnimationRemove(friend){
            this.$refs.media.className += " animated zoomOutUp"
            setTimeout(e =>{
                this.$emit('removeSuggestion', friend)
            }, 1000)
        }
    }
}
</script>

<style scoped>
span > .fa-trash:hover{
    cursor: pointer;

    transform-origin: top center;
    animation-name: swing;
    animation-duration: 0.4s;
}
</style>
