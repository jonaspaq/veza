<template>
<div class="container-fluid m-0 p-0 vh-100">
    <NavigationBar/>
    <router-view> </router-view>
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
.btn{
    background-image: linear-gradient(90deg, rgb(21, 42, 51), #203A43, #2C5364);
    color: white;
    border-color: transparent;
}
.btn:hover{
    background-image: linear-gradient(rgb(255, 255, 255), rgb(255, 255, 255));
    /* background-image: linear-gradient(90deg, rgb(43, 84, 102),rgb(63, 116, 133), rgb(75, 139, 167)); */
    color: rgb(21, 42, 51);
    /* color:white; */
    border: 1px solid rgb(56, 108, 131);
}
.btn:active, .btn:focus{
    border: 1px solid #2C5364 !important;
    box-shadow: 0 0 4px #2C5364 !important;
}
.anchorColor, .anchorColor:hover{
    color: #487E97;
}
.emptyBtn, .emptyBtn:active, .emptyBtn:focus{
    outline-color: #2C5364;
    border:0;
    background: transparent;
}
</style>