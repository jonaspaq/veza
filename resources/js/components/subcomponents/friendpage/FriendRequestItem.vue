<template>
    <div class="d-flex align-items-center shadow-sm py-2 friendItem bg-white px-2">
        <div class="friendItemImg centerImage mr-1">
            <img src="/images/user.png" :alt="friend.receiver.name">
        </div>
        <router-link to="/1" class="friendRecieverName anchorColor">{{ friend.receiver.name }}</router-link>

        <button class="emptyBtn ml-auto mr-2">
            <i class="fas fa-user-plus"></i>
        </button>
        <button v-if="!warn" class="emptyBtn ml-auto mr-1" @click="warnDeletion">
            <i class="fas fa-user-times"></i>
        </button>

        <button v-if="warn&&!loading" class="emptyBtn animated fadeIn ml-auto mr-2" @click="deleteRequest(friend)">
            <i class="fas fa-user-times"></i>
        </button>
        <button v-if="warn&&!loading" class="emptyBtn animated fadeIn mr-1" @click="warnDeletion">
            <i class="fas fa-times"></i>
        </button>

        <PleaseWaitLoader v-if="loading" class="ml-auto mr-1" />

    </div>
</template>

<script>
import PleaseWaitLoader from '../../loading_animations/PleaseWaitLoader'

export default {
    name: 'FriendRequestItem',
    components: { PleaseWaitLoader },
    props: ['friend']
}
</script>

<style>

</style>