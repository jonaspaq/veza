<template>
    <div class="modal fade" id="postDeleteModal" tabindex="-1" role="dialog" aria-labelledby="postDeleteModal" aria-hidden="true" v-if="toDeletePost">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content modalShadow">
            <div class="modal-body d-flex justify-content-center">
                <span class="text-center">Are you sure you want to delete this post?</span>
            </div>
            <hr class="m-0">
            <div class="row no-gutters">
                <div class="col d-flex justify-content-center">
                    <button type="button" class="emptyBtn p-2 w-100" data-dismiss="modal" ref="cancelPostDeletion"> Cancel </button>
                </div>
                <div class="col border-left d-flex justify-content-center">
                    <button type="button" class="emptyBtn p-2 w-100 text-danger" :class="{'disableBtn':deleteStatus}" @click.prevent="deletePost()"> {{deleteText}} </button>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'PostDeleteModal',

    data(){
        return {
            deleteText: 'Delete',
            deleteStatus: false
        }
    },

    methods:{
        deletePost(){
            let self = this
            self.deleteStatus = true
            self.deleteText = 'Deleting'
            this.$store.dispatch('posts/deletePost')
            .then((response)=>{
                self.deleteStatus = false
                self.$refs.cancelPostDeletion.click()
                self.deleteText = 'Delete'
            })
            .catch((err)=>{
                self.deleteStatus = false
                self.deleteText = 'Delete'
                console.log('Something went wrong')
            })
        }
    },

    computed:{
        toDeletePost(){
            return this.$store.getters['posts/toDeletePost']
        }
    }
}
</script>

<style scoped>
.disableBtn{
    pointer-events: none;
}
.modalShadow{
    box-shadow: 0 0 2px rgb(84, 228, 177);
}
.text-danger{
    color: #E74C3C !important;
}
</style>