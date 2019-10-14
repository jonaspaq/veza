<template>
    <div class="container-fluid m-0 p-0 mb-2">
        <div v-for="post in posts" v-bind:key="post.id" class="card-body bg-white border mt-2">

             <!-- Post list -->
            <PostItem v-bind:post="post" />
            
        </div>

        <!-- Post Delete Modal -->
            <PostDeleteModal />
    </div>
</template>

<script>
import PostItem from './PostItem'
import PostDeleteModal from './PostDeleteModal'

export default {
    name:'Posts',
    components:{ PostItem, PostDeleteModal },

    created(){
        this.getAllPost()
    },

    methods:{
        getAllPost(){
            let self = this
            this.$store.dispatch('posts/getAllPost')
            .catch((err)=>{
                console.log('Something went wrong')
            })
        }
    },

    computed:{
        posts(){
            return this.$store.getters['posts/posts']
        }
    }
}
</script>

