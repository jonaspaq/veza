<template> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4>Login</h4> 
                    <hr>
                    <p v-if="loginError" class="alert alert-danger">Incorrect email or password</p>
                    <form v-on:submit.prevent="login">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input v-model="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input v-model="password" type="password" class="form-control" id="password" placeholder="Password" autocomplete="off" required>
                        </div>
                        <button v-if="!loadingStatus" type="submit" class="btn btn-primary btn-block">Sign In</button>
                        <div v-if="loadingStatus" class="d-flex align-items-center">
                            <PleaseWaitLoader message="Signing in. . ." />
                        </div>
                    </form>
                    <hr>
                    <span class="d-block text-muted mt-3">Don't have an account? <router-link :to="{name:'register'}" class="anchorColor">Register here </router-link></span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import PleaseWaitLoader from '../loading_animations/PleaseWaitLoader'

export default {
    name: 'Login',
    components: { PleaseWaitLoader },

    data(){
        return {
            email:'test@example.com',
            password:'password'
        }
    },

    methods: {
        login(){
            this.$store.dispatch('auth/initiateLogin', {
                email: this.email,
                password: this.password
            })
            .then((response)=>{
                this.$router.push({name:'home'})
            })
            .catch((err)=>{
                console.log(err)
            })
        }
    },

    computed:{
        loadingStatus: function(){
            return this.$store.getters['auth/loginLoading']
        },
        loginError(){
            return this.$store.getters['auth/loginErrors']
        }
    }
}
</script>