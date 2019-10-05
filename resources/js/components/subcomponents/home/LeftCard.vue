<template>
    <div class="container-fluid m-0 p-0">
        <div class="card-body bg-white rounded shadow">
            <div class="row justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <div class="border rounded-circle overflow-hidden" style="height:150px; width:150px;">
                        <img src="https://img.icons8.com/clouds/2x/user.png" width="100%" alt="">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="col d-flex justify-content-center">
                        <router-link to="/walapa" class="text-dark text-decoration-none"> <h5>User Name</h5> </router-link>
                        
                    </div>       
                    <div class="col d-flex justify-content-center">
                        <a href="javascript:;" class="anchorColor"><small>Edit Profile</small></a>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'LeftCard'
}
</script>