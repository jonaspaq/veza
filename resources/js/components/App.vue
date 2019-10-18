<template>
<div class="container-fluid m-0 p-0 vh-100">
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
    components:{ NavigationBar },
}
</script>


<style>
*{
    font-family: 'Nunito', sans-serif;
}
.bg-primary{
    background-color: rgb(84, 228, 177) !important;
    color: white;
}
.btn-primary{
    background-color: rgb(84, 228, 177);
    border-radius: 2.5px;
    padding: 6px 20px;
    color: white;
    border-color: transparent;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active{
    background-color: rgb(84, 228, 177) !important;
    border-color: transparent !important;
    color:white;
    opacity: 0.9;
}
.btn-primary:focus{
    box-shadow: 0 0 0 1.5px rgb(78, 212, 166) !important;
}
.anchorColor, .anchorColor:hover{
    color: rgb(84, 228, 177);
}
.emptyBtn, .emptyBtn:active, .emptyBtn:focus{
    outline-color: rgb(84, 228, 177);
    border:0;
    background: transparent;
}
.dropdown-item:active{
    background-color: rgb(84, 228, 177);
}
</style>

<style scoped>
.viewHolderFluid{
    max-width: 1440px;
}
</style>