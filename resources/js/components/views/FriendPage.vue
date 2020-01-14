<template>
    <div class="container-fluid">
        <div class="row mt-4">

            <div class="col-lg-3">
                <LeftCard />
            </div>

            <div class="col-lg-9 px-0 px-lg-2">
                <div class="mb-2 ml-3">
                    
                    <router-link class="anchor-link" to="/friends/list" @click.native="navigateTo(1)">
                        <span class="badge badge-pill px-3 py-2" :class="{'bg-secondary': navSequence==1}">: Friends</span>
                    </router-link>
                    <router-link class="anchor-link" to="/friends/requests" @click.native="navigateTo(2)">
                        <span class="badge badge-pill px-3 py-2" :class="{'bg-secondary': navSequence==2}">: Requests</span>
                    </router-link>
                    <router-link class="anchor-link" to="/friends/sent-requests" @click.native="navigateTo(3)">
                        <span class="badge badge-pill px-3 py-2" :class="{'bg-secondary': navSequence==3}">: Sent Requests</span>
                    </router-link>

                </div>
                
                <router-view> </router-view>
            </div>

        </div>
    </div>
</template>

<script>
import LeftCard from '../subcomponents/home/LeftCard'

export default {
    name: 'FriendList',
    components: { LeftCard },

    created(){
        this.navigateTo(this.$route.meta.navSequence)
    },

    data(){
        return {
            navSequence: 1
        }
    },

    methods: {
        navigateTo(goTo){
            this.navSequence = goTo
        }
    }
}
</script>

<style lang="scss" scoped>
.anchor-link{
    color: var(--primary-color-lighter);

    &:hover{
        color: var(--primary-color-darker);
    }
}
</style>
