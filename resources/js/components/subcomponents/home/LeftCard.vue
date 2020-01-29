<template>
    <div class="container-fluid m-0 p-0 position-lg-sticky">
        <div class="card-body bg-white rounded shadow-sm d-none d-lg-block">
            <div class="row justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <div class="border rounded-circle centerImage" style="height:150px; width:150px;">
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

        <div class="card-body bg-white rounded shadow-sm mt-2 p-0 leftCardNav">
            <div class="row">
                <div class="col-12">
                    <ul class="list-group w-100 list-unstyled">
                        <router-link :to="{name:'home'}" class="list-group-item anchorUnstyled">
                            <li class="d-flex align-items-center">
                                <img src="/images/home.png" alt="home" width="19px" height="19px">
                                <span class="ml-1 d-none d-lg-block">Home</span>  
                            </li> 
                        </router-link>
                        <FriendNavigation />
                        <li class="list-group-item d-flex align-items-center dropdown">
                            <img src="/images/bell.png" alt="bell" width="19px" height="19px">
                            <span class="ml-1 d-none d-lg-block">Notifications</span>  
                            <!-- <span class="badge ml-auto bg-secondary">4</span> -->
                        </li> 
                        <li class="list-group-item d-flex align-items-center">
                            <img src="/images/store.png" alt="store" width="19px" height="19px">
                            <span class="ml-1 d-none d-lg-block">Marketplace</span>  
                            <!-- <span class="badge bg-secondary ml-auto">1</span> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import FriendNavigation from './subcomponents/FriendNavigation'
export default {
    name:'LeftCard',
    components:{ FriendNavigation },

    computed:{
        user(){
            return this.$store.getters['auth/user']
        }
    }
}
</script>

<style lang="scss" scoped>
.leftCardNav{
    z-index: 2;
}
.list-group-item{

    @media (max-width: 768.98px) {
        border: 0;
        border-radius: 0;

        box-shadow: 0 0 0 0.1px gray;
    }

    &:hover{
        cursor: pointer;
        transition: background 0.4s ease;
        background: #f3f8f4;
        outline: 0;
    }
}

@media (max-width: 768.98px) {
    .leftCardNav{
        position:fixed !important;
        bottom: 0px;
        left:0px;
        z-index: 5;
        width:100vw;
    }
    .list-group{
        flex-direction: row;

        &-item{
            width: 100%;
            justify-content: center;
        }
    }
    .list-group-item > li {
        justify-content: center;
    }
}

 /* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .position-lg-sticky{
        position:sticky;
        top: 80px;
    }
}
</style>