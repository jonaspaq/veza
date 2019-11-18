<template>
    <div class="container-fluid m-0 p-0 mb-2">
        <div v-if="Object.entries(posts).length !== 0">
            <div v-for="post in posts" v-bind:key="post.id" class="card-body bg-white border mt-2">

             <!-- Post list -->
            <PostItem v-bind:post="post" />
            
            </div>
        </div>
        <div v-else>
            <div v-for="n in 10" :key="n.id" class="card-body bg-white border mt-2">
                <PostsLoader />
            </div>
        </div>
        

            <!-- Post Delete Modal -->
            <PostDeleteModal />

            <!-- Post Edit Modal -->
            <PostEditModal />
    </div>
</template>

<script>
import PostsLoader from '../../loading_animations/PostsLoader'
import PostItem from './PostItem'
import PostDeleteModal from './PostDeleteModal'
import PostEditModal from './PostEditModal'

export default {
    name:'Posts',
    components:{ PostsLoader, PostItem, PostDeleteModal, PostEditModal },

    created(){
        this.getAllPost()
    },

    methods:{
        getAllPost(){
            let self = this
            this.$store.dispatch('posts/getAllPost')
            .catch((err)=>{
                console.log(err)
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

