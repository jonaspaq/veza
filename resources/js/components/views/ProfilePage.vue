<template>
    <div class="container-fluid">
        <div class="row profile-cover align-items-center">
            <div class="col-12">
                <h2 class="text-white text-center">{{ user.name }}</h2>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProfilePage',

    computed:{
        user(){
            return this.$store.getters['auth/user']
        }
    }
}
</script>

<style lang="scss" scoped>
.container-fluid{
    width: 100vw !important;
    position: relative;
    left: 50%;
    transform: translateX(-50.001%);
}
.profile-cover{
    background: var(--primary-color-linear);
    height: 20vh;
    padding: 0;
}
</style>