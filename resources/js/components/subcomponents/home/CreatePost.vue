<template>
    <div class="card mt-2 mt-lg-0">
        <div class="card-header">
            Create post 
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-lg-12">
                    <form v-on:submit.prevent="addPost">
                    <textarea v-model="content" placeholder="What's on your mind?" class="form-control"></textarea> 
                    <div class="d-flex flex-row-reverse">
                        <button v-if="!loadingStatus" class="btn d-block mt-2">Post</button>
                        <PleaseWaitLoader v-if="loadingStatus" />
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
            loadingStatus: false
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