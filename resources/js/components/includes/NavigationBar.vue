<template>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
    <router-link :to="{name:'home'}" class="navbar-brand d-flex align-items-center">
        <img src="/icons/144-White.png" width="30px" alt="Veza Logo" class="mr-2">
        Veza
    </router-link>
    <button v-if="loginStatus" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>   
    <div v-if="loginStatus" class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-0 mr-lg-auto">
            <!-- <li class="nav-item active">
              <router-link :to="{name:'login'}" class="nav-link">Home</router-link>
            </li> -->
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
        <span class="text-white d-flex align-items-center"> 
            <div class="rounded-circle mr-2 centerImage" style="height:28px; width:28px;">
                <img src="/images/user.png" alt="User Profile Picture">
            </div>
            {{ user.name }} 
        </span>
        <a class="nav-link text-white px-0 px-lg-3" v-on:click.prevent="logout" href="javascript:;"><i class="fas fa-sign-out-alt"></i> Logout</a>
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