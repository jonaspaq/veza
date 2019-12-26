<template>
    <div class="container-fluid m-0 p-0 h-100 w-100">
        <div class="row pl-2 pr-3">
            <div class="border rounded-circle" style="height:40px; width:40px;">
                <img src="/images/user.png" width="100%">
            </div>
            <div class="col-8 align-self-center">
                <span class="d-block">{{post.user.name}}</span>
                <small class="d-block text-muted">{{post.created_at}}</small>
            </div>
            <div class="ml-auto">
                <div class="dropdown dropleft">
                    <button class="emptyBtn" type="button" data-toggle="dropdown" @click.prevent>
                        <i class="fas fa-chevron-down">-</i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#postEditModal" @click="editPost(post)">Edit</a>
                        <a class="dropdown-item" href="javascript:;" v-on:click.prevent="deletePost(post)" data-toggle="modal" data-target="#postDeleteModal">Delete</a>
                    </div>
                    </div>
            </div>
        </div>
        <div class="row pl-3 pr-3 mt-2">
            <p class="m-0 p-0 text-break">{{post.content}}</p>
        </div>
    </div>
</template>

<script>
import PleaseWaitLoader from '../../../loading_animations/PleaseWaitLoader'

export default {
    name: 'PostItem',
    props: ['post'],

    methods:{
        deletePost(post){
            this.$store.dispatch('posts/toDeletePost', post)
        },
        editPost(post){
            this.$store.dispatch('posts/toEditPost', post)
        }
    },
}
</script>

<style scoped>
.disableBtn{
    pointer-events: none;
}
.text-break{
     white-space: pre-wrap;
}
</style>
