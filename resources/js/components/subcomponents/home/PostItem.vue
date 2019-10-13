<template>
    <div class="container-fluid m-0 p-0 h-100 w-100">
        <h6 class="alert alert-danger" v-if="deletingStatus"> Deleting post. . . </h6>
        <div class="row pl-2 pr-3" v-bind:class="{ disableDiv : deletingStatus }">
            <div class="border rounded-circle" style="height:40px; width:40px;">
                <img src="/images/user.png" width="100%">
            </div>
            <div class="col-8 align-self-center">
                <span class="d-block">{{post.user.name}}</span>
                <small class="d-block text-muted">{{post.created_at}}</small>
            </div>
            <div class="ml-auto">
                <div class="dropleft">
                    <button class="emptyBtn" type="button" data-toggle="dropdown">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:;">Edit</a>
                        <a class="dropdown-item" href="javascript:;" v-on:click.prevent="deletePost(post)">Delete</a>
                    </div>
                    </div>
            </div>
        </div>
        <div class="row pl-3 pr-3 mt-2 text-break">
            {{post.content}} 
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostItem',
    props: ['post'],

    data(){
        return {
            deletingStatus: false
        }
    },

    methods:{
        deletePost(post){
            let self = this
            self.deletingStatus = true
            this.$store.dispatch('posts/deletePost', post)
        }
    },
}
</script>

<style scoped>
.disableDiv{
    pointer-events: none;
}
</style>