<template>
    <div class="container-fluid" v-show="userDetailsLoaded">
        <div class="row mt-4">

            <div class="col-lg-3">
                <!-- Left side of home  -->
                <LeftCard />
            </div>

            <div class="col-lg-6">
                <!-- Create Post Component -->
                <CreatePost />

                <!-- Post list Component -->
                <Posts />

            </div>

            <div class="col-lg-3">
                <RightCard />
            </div>

        </div>
    </div>
</template>

<script>
import LeftCard from '../subcomponents/home/LeftCard'
import RightCard from '../subcomponents/home/RightCard'
import Posts from '../subcomponents/home/Posts'
import CreatePost from '../subcomponents/home/CreatePost'

export default {
    name:'Home',
    components:{
        Posts, CreatePost, LeftCard, RightCard
    },

    data() {
        return {
            userDetailsLoaded: false
        }
    },

    beforeCreate: function() {
        this.$store.dispatch('auth/setUserDetails')
        .then(response => {
            this.userDetailsLoaded = true
        })
        .catch(err => {
            localStorage.removeItem('Session')
            location.reload()
        })
    }
}
</script>
