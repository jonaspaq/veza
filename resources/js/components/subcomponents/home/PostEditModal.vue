<template>
    <div class="modal fade" id="postEditModal" ref="postEditModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="emptyBtn close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="POST">
                    <textarea v-model="toEditPost.content" v-on:keyup="setTextAreaHeightOnType" ref="setTextAreaHeightOnType" placeholder="How's your day?" class="form-control"></textarea> 
                </form>
            </div>
            <div class="modal-footer" v-if="!updateStatus">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="editPost">Save changes</button>
            </div>
            <div class="modal-footer" v-if="updateStatus">
                <PleaseWaitLoader message="Editing Post. . ." />
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import PleaseWaitLoader from '../PleaseWaitLoader'

export default {
    name: 'PostEditModal',
    components: { PleaseWaitLoader },

    beforeUpdate: function(){
        const theElement = this.$refs.setTextAreaHeightOnType
        setTimeout(()=>{
            theElement.style.height = '5px'
            theElement.style.height = (theElement.scrollHeight)+"px"
        },200)
    },

    data(){
        return {
            updateStatus: false
        }
    },

    methods:{
        setTextAreaHeightOnType(){
            const theElement = this.$refs.setTextAreaHeightOnType
            theElement.style.height = '5px'
            theElement.style.height = (theElement.scrollHeight)+"px"
        }, 
        editPost(){
            let self = this
            self.updateStatus = true
            self.$store.dispatch('posts/editPost')
            .then((response)=>{
                self.updateStatus = false
                console.table(response.data.data)
            })
            .catch((err)=>{
                self.updateStatus = false
                console.log('Something went wrong')
            })
        }
    },

    computed:{
        toEditPost(){
            return this.$store.getters['posts/toEditPost']
        }
    }
}
</script>

<style scoped>
.form-control{
    border: 0px;
    box-shadow: none !important;
    height: auto;
    max-height: 400px;

    /* transition: 0.2s ease; AUTO TEXTAREA HEIGHT NOT WORKING IF THIS IS ACTIVE */
}
textarea{
    resize: none;
}
</style>