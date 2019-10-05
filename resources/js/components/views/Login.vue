<template> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <p v-if="loginError" class="alert alert-danger">Incorrect email or password</p>
                    <form v-on:submit.prevent="login">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input v-model="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input v-model="password" type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <button v-if="!loadingStatus" type="submit" class="btn btn-block">Sign In</button>
                        <div v-if="loadingStatus" class="d-flex align-items-center">
                            <div class="spinner-border spinner-border-sm text-info mr-1" role="status">
                            </div>
                            <span>Signing in. . .</span>
                        </div>
                    </form>
                    <hr>
                    <span class="d-block text-muted mt-3">Don't have an account? Register <router-link :to="{name:'register'}">here </router-link></span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'Login',
    data(){
        return {
            email:'johndoe@gmail.com',
            password:'123456'
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