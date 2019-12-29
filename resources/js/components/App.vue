<template>
<div class="container-fluid m-0 p-0 vh-100 overflow-auto">
    <NavigationBar/>

    <div class="container-fluid m-0 p-0 viewHolderFluid mx-auto">
        <router-view> </router-view>
    </div>
</div>
</template>

<script>
import NavigationBar from './includes/NavigationBar'

export default {
    name: 'App',
    components:{ NavigationBar }
}
</script>

<style scoped>
.viewHolderFluid{
    max-width: 1440px;
}
</style>