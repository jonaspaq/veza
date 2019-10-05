<template> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form v-on:submit.prevent="register">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input v-model="name" type="text" class="form-control" id="name" placeholder="Enter name">
                            <small v-if="errors.name" class="form-text text-danger">{{ String(errors.name)}}</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input v-model="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small v-if="errors.email" id="emailHelp" class="form-text text-danger">{{ String(errors.email)}}</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input v-model="password" type="password" class="form-control" id="password" placeholder="Password">
                            <small v-if="errors.password" class="form-text text-danger">{{ String(errors.password)}}</small>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm password</label>
                            <input v-model="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm password">
                            <small v-if="errors.password_confirmation" class="form-text text-danger">{{ String(errors.password_confirmation)}}</small>
                        </div>
                        <button v-if="!loadingStatus" type="submit" class="btn btn-block">Register</button>
                        <div v-if="loadingStatus" class="d-flex align-items-center">
                            <div class="spinner-border spinner-border-sm text-info mr-1" role="status">
                            </div>
                            <span>Please wait </span>
                        </div>
                    </form>
                    <hr>
                    <span class="d-block text-muted mt-3">Click <router-link :to="{name:'login'}">here</router-link> to sign in</span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'Register',
    data(){
        return {
            name:'',
            email:'',
            password:'',
            password_confirmation:'',

            loadingStatus: false,
            errors:''
        }
    },

    methods: {
        register: function(){
            let self = this
            self.loadingStatus = true

            axios.post('/api/user/register', {
                name: self.name,
                email: self.email,
                password: self.password,
                password_confirmation: self.password_confirmation
            })
            .then((response)=>{
                console.log(response.data)
                self.errors = ''
                self.loadingStatus = false
                self.$router.push({name:'login'})
            })
            .catch((err)=>{
                self.errors = err.response.data.errors
                self.loadingStatus = false
            })
        }
    }
}
</script>