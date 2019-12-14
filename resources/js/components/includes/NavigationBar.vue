<template>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
    <a class="navbar-brand" href="javascript:;">
        <img src="https://jonaspaq.github.io/vuespa/public/images/hand-peace.png" width="30px" alt="Brand Logo Hands Peace">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>   
    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-0 mr-lg-auto">
            <li class="nav-item active">
              <router-link :to="{name:'login'}" class="nav-link">Home</router-link>
            </li>
            <!-- <li class="nav-item active">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"      aria-expanded="false">
                  Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit" v-on:click.prevent>Search</button>
            </form> -->
        </ul>
        <span v-if="loginStatus" class="text-white d-flex align-items-center"> 
            <div class="border rounded-circle bg-white mr-2" style="height:28px; width:28px;">
                <img src="/images/user.png" width="100%" alt="User Profile Picture">
            </div>
            {{ user.name }} 
        </span>
        <a v-if="loginStatus" class="nav-link text-white px-0 px-lg-3" v-on:click.prevent="logout" href="javascript:;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</nav>
</template>

<script>
export default {
    name:'NavigationBar',

    methods:{
        logout: function(){
            let self = this
            this.$store.dispatch('auth/initiateLogout')
            .then((response)=>{
                // self.$router.push({name:'login'})
                location.replace('/')
            })
            .catch((err)=>{
                console.log(err)
            })
        }
    },

    computed:{
        user(){
            return this.$store.getters['auth/user']
        },
        loginStatus(){
            return this.$store.getters['auth/loginStatus']
        }
    }
}
</script>


<style scoped>
.navbar{
    background: var(--primary-color-linear);
    z-index: 100;
}
.navbar-toggler{
    outline-color: transparent;
}
</style>