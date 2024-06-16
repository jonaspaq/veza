<template>
    <div class="container-fluid">
        <div class="row mt-4">

            <div class="col-lg-3">
                <!-- Left side of home component  -->
                <LeftCard />
            </div>

            <div class="col-lg-6">
                <EditProfileDetails v-bind:userId="userId" />
            </div>
        </div>
    </div>
</template>

<script>
import LeftCard from '../subcomponents/home/LeftCard'
import EditProfileDetails from './sub_views/EditProfileDetails.vue'

export default {
    name:'EditProfile',
    components:{
        LeftCard, EditProfileDetails
    },
    computed: {
        userId() {
            return parseInt(this.$route.query.user)
        }
    }
}
</script>
