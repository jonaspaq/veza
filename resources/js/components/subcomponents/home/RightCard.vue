<template>
    <div class="card-body bg-white shadow-sm rounded position-lg-sticky">
        <div class="row pb-3">
            <div class="col">
                <span class="pb-2 anchorColor">Friend Suggestions</span>
            </div>
        </div>
        <div class="media align-items-center">
            <div class="border rounded-circle" style="height:40px; width:40px;">
                <img src="/images/user.png" width="100%">
            </div>
            <div class="media-body pl-2">
                <div class="row">
                    <div class="col-10">
                        <span>Friend Name</span>
                    </div>
                    <div class="col-1">
                        <span><i class="fas fa-trash"></i></span>
                    </div>
                    <div class="col-12">
                        <a href="javascript:;" class="anchorColor"><small>Add Friend</small></a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="media align-items-center">
            <div class="border rounded-circle" style="height:40px; width:40px;">
                <img src="/images/user.png" width="100%">
            </div>
            <div class="media-body pl-2">
                <div class="row">
                    <div class="col-10">
                        <span>Friend Name</span>
                    </div>
                    <div class="col-1 removeFriendSuggestion">
                        <span><i class="fas fa-trash"></i></span>
                    </div>
                    <div class="col-12">
                        <a href="javascript:;" class="anchorColor"><small>Add Friend</small></a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="media align-items-center">
            <div class="border rounded-circle" style="height:40px; width:40px;">
                <img src="/images/user.png" width="100%">
            </div>
            <div class="media-body pl-2">
                <div class="row">
                    <div class="col-10">
                        <span>Friend Name</span>
                    </div>
                    <div class="col-1">
                        <span><i class="fas fa-trash"></i></span>
                    </div>
                    <div class="col-12">
                        <a href="javascript:;" class="anchorColor"><small>Add Friend</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RightCard'
}
</script>


<style scoped>
.fa-trash{
    cursor: pointer;
}

 /* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .position-lg-sticky{
        position:sticky;
        top: 80px;
    }
}
</style>