<template>
    <div class="container-fluid">
        <div class="row mt-4">

            <div class="col-lg-3">
                <LeftCard />
            </div>

            <div class="col-lg-6">
                <!-- Create Post Component -->
                <CreatePost />

                <!-- Post list Component -->
                <Posts />

            </div>

            <div class="col-lg-3">
                <div class="card-body bg-white rounded shadow-sm">
                    <span>Coming soon! <i class="fas fa-smile-beam"></i></span>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import LeftCard from '../subcomponents/home/LeftCard'
import Posts from '../subcomponents/home/Posts'
import CreatePost from '../subcomponents/home/CreatePost'

export default {
    name:'Home',
    components:{
        Posts, CreatePost, LeftCard
    },

    beforeCreate: function(){
        this.$store.dispatch('auth/setUserDetails')
    },

    computed: {

    }

}
</script>


<style scoped>
</style>