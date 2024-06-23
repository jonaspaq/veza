<template>
    <div class="card-body bg-white rounded shadow-sm d-none d-lg-block">
        <div class="row">
            <div class="col-6">
                <label>Email</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" v-bind:value="userDetails.email" disabled>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label>First name</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="userDetails.first_name" placeholder="First name">
                </div>
            </div>
            <div class="col-6">
                <label>Last name</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="userDetails.last_name" placeholder="Last name">
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label>Middle name</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="userDetails.middle_name" placeholder="Middle name">
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <PleaseWaitLoaderVue v-if="loadingStatus" v-bind:message="loadingMessage" />
                <button v-if="!loadingStatus" @click="updateDetails" class="btn btn-primary d-block shadow-sm">Update</button>
            </div>
        </div>
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
        this.userDetails = this.authDetails
    },

    data() {
        return {
            userDetails: {},
            loadingStatus: false
        }
    },

    methods: {
        updateDetails() {
            this.loadingStatus = true





            this.loadingStatus = false
        }
    },

    computed: {
        loadingMessage() {
            return "Updating details"
        },
        authDetails() {
            return this.$store.getters['auth/user']
        }
    }
}
</script>
