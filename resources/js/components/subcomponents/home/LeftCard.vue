<template>
    <div class="container-fluid m-0 p-0 position-lg-sticky">
        <div class="card-body bg-white rounded shadow-sm d-none d-lg-block">
            <div class="row justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <div class="border rounded-circle overflow-hidden" style="height:150px; width:150px;">
                        <img src="/images/user.png" width="100%" alt="">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="col d-flex justify-content-center">
                        <router-link to="/user/profile/" class="text-dark text-decoration-none"> <h5>{{user.name}}</h5> </router-link>
                    </div>       
                    <div class="col d-flex justify-content-center">
                        <a href="javascript:;" class="anchorColor"></a>
                        <router-link :to="{name:'editProfile', query : {user: user.id}}" class="anchorColor text-decoration-none"><small>Edit Profile</small></router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body bg-white rounded shadow-sm mt-2 p-0">
            <div class="row">
                <div class="col-12 overflow-auto">
                    <ul class="list-group w-100 list-unstyled">
                        <li class="list-group-item d-flex align-items-center">
                            <!-- <i class="fas fa-bell"></i> -->
                            <img src="images/bell.png" alt="marketplace" width="19px" height="19px">
                            <span class="ml-1">Notifications</span>  
                            <span class="badge badge-primary ml-auto">4</span>
                        </li> 
                        <li class="list-group-item d-flex align-items-center">
                            <!-- <i class="fas fa-user-friends"></i> -->
                            <img src="images/friendship.png" alt="marketplace" width="19px" height="19px">
                            <span class="ml-1">Friends</span>  
                            <span class="badge badge-primary ml-auto">1</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <img src="images/store.png" alt="marketplace" width="18px" height="18px">
                            <span class="ml-1">Marketplace</span>  
                            <!-- <span class="badge badge-primary ml-auto">1</span> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name:'LeftCard',

    computed:{
        user(){
            return this.$store.getters['auth/user']
        }
    }
}
</script>

<style scoped>
.list-group-item:hover{
    cursor: pointer;
    transition: background 0.4s ease;
    background: rgba(240, 247, 242, 0.815);
}

 /* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .position-lg-sticky{
        position:sticky;
        top: 80px;
    }
}
</style>