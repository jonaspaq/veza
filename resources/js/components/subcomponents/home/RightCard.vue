<template>
    <div class="card-body bg-white shadow-sm rounded position-lg-sticky">
        <div class="row pb-3">
            <div class="col">
                <span class="pb-2 anchorColor">Friend Suggestions</span>
            </div>
        </div>
        <div v-if="Object.entries(friendSuggestions).length === 0">
            <div v-for="n in 5" :key="n.id">
                <FriendSuggestionLoader />
            </div>
        </div>
        <div v-else>
            <div v-for="friend in friendSuggestions" v-bind:key="friend.id">
                <FriendItem v-bind:friend="friend" @removeSuggestion="removeSuggestion" />
            </div>
        </div>
    </div>
</template>

<script>
import FriendItem from './subcomponents/FriendItem'
import FriendSuggestionLoader from '../../loading_animations/FriendSuggestionLoader'

export default {
    name: 'RightCard',
    components: { FriendSuggestionLoader, FriendItem },

    created(){
        this.getFriendSuggestions()
    },

    data: () => ({
        friendSuggestion: ''
    }),

    methods:{
        getFriendSuggestions(){
            axios.get('/api/friendSuggestions')
            .then( response => {
                const res = response.data
                const resCount = Object.entries(res)
                if(resCount!=false){
                    this.friendSuggestion = response.data
                }else{
                    this.friendSuggestion = false
                }        
            })
            .catch( err => {
                console.log(err)
            })
        },
        removeSuggestion(value){
            this.friendSuggestion.splice(this.friendSuggestion.indexOf(value), 1)
        }
    },

    computed: {
        friendSuggestions(){
            if(this.friendSuggestion != false){
                // Show only 5 friend suggestions at a time
                return this.friendSuggestion.slice(0,5)
            }
            return this.friendSuggestion = false
        }
        
    }
}
</script>


<style scoped>

 /* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .position-lg-sticky{
        position:sticky;
        top: 80px;
    }
}
</style>