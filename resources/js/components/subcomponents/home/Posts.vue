<template>
    <div class="container-fluid m-0 p-0 mb-2">
        <div v-for="post in posts" v-bind:key="post.id" class="card-body bg-white border mt-2">
            <div class="row pl-2 pr-3">
                <div class="border rounded-circle" style="height:40px; width:40px;">
                    <img src="https://img.icons8.com/clouds/2x/user.png" width="100%">
                </div>
                <div class="col-8 align-self-center">
                    <span class="d-block">{{post.user.name}}</span>
                    <small class="d-block text-muted">{{post.created_at}}</small>
                </div>
                <div class="ml-auto">
                    <!-- <button class="emptyBtn"><i class="fas fa-chevron-down"></i></button> -->
                    <div class="dropleft">
                        <button class="emptyBtn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:;">Edit</a>
                            <a class="dropdown-item" href="javascript:;">Delete</a>
                        </div>
                        </div>
                </div>
            </div>
            <div class="row pl-3 pr-3 mt-2 text-break">
                {{post.content}} 
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Posts',

    created(){
        this.getAllPost()
    },

    methods:{
        getAllPost(){
            let self = this
            this.$store.dispatch('posts/getAllPost', this.$store.getters['auth/token'])
            .then((response)=>{
                // console.log(response.data)
                // self.posts = response.data.data
            })
            .catch((err)=>{
                console.log('Getting post list failed!')
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