<template>
    <div class="modal fade" id="postEditModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="POST">
                    <input type="hidden" v-model="toEditPost.id" readonly>
                    <textarea v-model="toEditPost.content" v-on:input="setTextAreaHeightOnType" ref="setTextAreaHeightOnType" placeholder="How's your day?" class="form-control"></textarea> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostEditModal',

    beforeUpdate: function(){
        this.setTextAreaHeightOnType
    },

    methods:{
        setTextAreaHeightOnType(){
            const theElement = this.$refs.setTextAreaHeightOnType
            theElement.style.height = 'auto'
            theElement.style.height = (theElement.scrollHeight)+"px"
        }, 
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
}
textarea{
    resize: none;
}
</style>