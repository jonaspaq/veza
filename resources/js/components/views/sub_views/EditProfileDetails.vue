<template>
    <div class="card-body bg-white rounded shadow-sm d-none d-lg-block">
        <div class="row">
            <div class="col-6">
                <label for="email">Email</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" v-model="userDetails.email" disabled>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label for="firstName">First name</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="userDetails.first_name" placeholder="First name">
                </div>
            </div>
            <div class="col-6">
                <label for="lastName">Last name</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="userDetails.last_name" placeholder="Last name">
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label for="middleName">Middle name</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="userDetails.middle_name" placeholder="Middle name">
                </div>
            </div>
        </div>

        <PleaseWaitLoaderVue v-bind:message="loadingMessage" />
    </div>
</template>

<script>
import PleaseWaitLoaderVue from '../../loading_animations/PleaseWaitLoader.vue';

export default {
    name: 'EditProfileDetails',
    components: {
        PleaseWaitLoaderVue
    },
    props: [
        'userId'
    ],

    created() {
        axios.get(`/api/user/${this.userId}`)
            .then((response)=>{
                this.userDetails = response.data
            })
            .catch((err)=>{

            });

    },
    data() {
        return {
            userDetails: {}
        }
    },

    computed: {
        loadingMessage() {
            return "Loading details"
        }
    }
}
</script>
