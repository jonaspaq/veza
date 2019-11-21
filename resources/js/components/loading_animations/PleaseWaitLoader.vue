<template>
    <div class="d-flex align-items-center">
        <div class="spinner-border spinner-border-sm anchorColor" role="status"></div>
        <span class="ml-1">{{message}}</span>
    </div>
</template>

<script>
export default {
    name:'PleaseWaitLoader',
    props: ['message']
}
</script>