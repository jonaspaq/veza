<template>
    <div class="modal fade" id="postDeleteModal" tabindex="-1" role="dialog" aria-labelledby="postDeleteModal" aria-hidden="true" v-if="toDeletePost">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content modalShadow">
            <div class="modal-body d-flex justify-content-center">
                <span class="text-center">Are you sure you want to delete this post?</span>
            </div>
            <hr class="m-0">
            <div class="row no-gutters" v-show="!deleteStatus">
                <div class="col d-flex justify-content-center">
                    <button type="button" class="emptyBtn p-2 w-100" data-dismiss="modal" @click="unsetDeletePost" ref="cancelPostDeletion"> Cancel </button>
                </div>
                <div class="col border-left d-flex justify-content-center">
                    <button type="button" class="emptyBtn p-2 w-100 anchorColor" @click.prevent="deletePost()"> Delete </button>
                </div>
            </div>
            <div class="row d-flex justify-content-center py-2" v-if="deleteStatus">
                <PleaseWaitLoader message="Deleting post. . ." />
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name:'PostDeleteModal',
    components: { PleaseWaitLoader },

    data(){
        return {
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
        },
        unsetDeletePost(){
            this.$store.commit('posts/UNSET_TO_DELETE_POST')
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
.modalShadow{
    box-shadow: 0 0 2px rgb(84, 228, 177);
}
.text-danger{
    color: #E74C3C !important;
}
</style>