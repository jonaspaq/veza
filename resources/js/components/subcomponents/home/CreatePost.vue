<template>
    <div class="card mt-2 mt-lg-0">
        <div class="card-body bg-white">
            <div class="row mb-2">
                <div class="col">
                    <span class="anchorColor">
                        <i class="fas fa-cloud-sun" v-if="currentTime<=17"></i>
                        <i class="fas fa-cloud-moon" v-if="currentTime>=18"></i> 
                        Create post
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form v-on:submit.prevent="addPost">
                    <textarea v-model="content" placeholder="How's your day?" class="form-control" required></textarea> 
                    <div class="d-flex flex-row-reverse pt-2">
                        <button v-if="!loadingStatus" class="btn btn-primary d-block shadow-sm"><i class="far fa-share-square"></i> Post</button>
                        <PleaseWaitLoader message="Please wait. . ." v-if="loadingStatus" />
                    </div>     
                    </form>                         
                </div>   
            </div>
        </div>
    </div>
</template>

<script>
import PleaseWaitLoader from '../PleaseWaitLoader'

export default {
    name:'CreatePost',
    components:{
        PleaseWaitLoader
    },

    data(){
        return {
            content:'',
            loadingStatus: false,
            currentTime: new Date().getHours()
        }
    },
    methods:{
        addPost(){
            this.loadingStatus = true
            let self = this
            this.$store.dispatch('posts/addPost', {
                content: this.content,
                token: this.$store.getters['auth/token']
            })
            .then((response)=>{
                self.content = ''
                self.loadingStatus = !self.loadingStatus
            })
            .catch((err)=>{
                console.log(err)
                self.loadingStatus = !self.loadingStatus
            })
        }
    }
}
</script>


<style scoped>

</style>