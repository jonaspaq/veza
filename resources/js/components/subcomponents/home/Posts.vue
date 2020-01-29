<template>
    <div class="container-fluid m-0 p-0 mb-2">

        <div v-if="Object.entries(posts).length !== 0">
            <div v-for="post in posts" :key="post.id" class="card-body bg-white border mt-2">

                <!-- Post list -->
                <PostItem v-bind:post="post" />
            
            </div>
        </div>
        <div v-else-if="Object.entries(posts).length === 0 && loading">
            <div v-for="n in 5" :key="n.id" class="card-body bg-white border mt-2">
                <PostsLoader />
            </div>
        </div>
        

            <!-- Post Delete Modal -->
            <PostDeleteModal />

            <!-- Post Edit Modal -->
            <PostEditModal />
        
        <div v-if="!loading&&posts==''" class="container-fluid mt-2 no-post-only">
            <img src="/icons/192-Bluegreen.png" alt="">
            <h2>Welcome to Veza</h2>
        </div>
    </div>
</template>

<script>
import PostsLoader from '../../loading_animations/PostsLoader'
import PostItem from './subcomponents/PostItem'
import PostDeleteModal from './PostDeleteModal'
import PostEditModal from './PostEditModal'

export default {
    name:'Posts',
    components:{ PostsLoader, PostItem, PostDeleteModal, PostEditModal },

    created(){
        this.getAllPost()
    },

    data(){
        return {
            loading: true
        }
    },

    methods:{
        getAllPost(){
            let self = this
            this.$store.dispatch('posts/getAllPost')
            .then(response =>{
                this.loading = false
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

<style lang="scss" scoped>
.no-post-only{
    height: 45vh;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;

    h2{
        color: var(--primary-color-nonlinear);
    }
}
</style>

