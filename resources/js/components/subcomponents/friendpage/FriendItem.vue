<template>
    <div class="d-flex align-items-center shadow-sm py-2 friendItem bg-white px-2">
        <div class="friendItemImg centerImage mr-1">
            <img src="/images/user.png" :alt="friend.receiver.name">
        </div>
        <router-link to="/1" class="friendRecieverName anchorColor">{{ friend.receiver.name }}</router-link>

        <div class="dropdown dropleft ml-auto">
            <button class="dropdown-toggle emptyBtn mr-1 px-1" type="button" id="friendOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu" aria-labelledby="friendOptions">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'FriendItem',
    props: ['friend'],

}
</script>

<style lang="scss" scoped>
.friendRecieverName{
    font-weight: 600;
    font-size: 14px;
    max-width: 200px;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;

    @media(min-width: 768px){
        width: 250px;
    }
}

.friendItem{
    border-radius: 4px;
    
    &Img{
        border-radius: 50px;
        width: 30px;
        height: 30px;
        box-shadow: 0 0 0 .2px rgb(211, 211, 211);
    }

    .fa-user-plus{
        color: #28B463;
    }
    .fa-user-times{
        color: #EC7063;
    }
    .fa-times{
        color: #ebeb6a;
    }
}
</style>