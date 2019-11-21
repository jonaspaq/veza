<template>
    <div ref="friendContainer" class="animated rounded-lg rounded-top friendRequestsContainer bg-white" v-bind:class="{'slideInUp': status}">
        <p @click="open" style="height:px">hi</p>                                
    </div>
</template>

<script>
export default {
    name: 'FriendRequestContainer',
    props: ['status'],

    methods:{
        open(){
            // this.$refs.friendContainer.classList += " slideInUp"
        }
    },
}
</script>

<style scoped>
@media (max-width: 768px) {
    .friendRequestsContainer{
        visibility: hidden;
        /* transform: translate3d(12.5vw, -25vh, 0px) !important; */
        overflow: auto;
        position: absolute;
        left: -25.18vw;
        top: -45.2vh;
        height: 45vh;
        width: 100vw;
        z-index: -1;
        border-top: 2px solid rgb(170, 170, 170);
    }
    .slideInUp{
        visibility: visible;
    }
}
</style>