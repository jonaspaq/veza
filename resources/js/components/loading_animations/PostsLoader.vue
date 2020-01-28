<template>
    <div class="container-fluid m-0 p-0 h-100 w-100">
        <div class="row pl-2 pr-3">
            <div class="border rounded-circle load-placeholder" style="height:40px; width:40px;"></div>
            <div class="col-4">
                <div class="row">
                    <div class="col-8 dummyColHead load-placeholder"></div>
                </div>
                <div class="row">
                    <div class="col-6 dummyColHead load-placeholder"></div>
                </div>
            </div>
        </div>
        <div class="row pl-3 pr-3 mt-2">
            <div class="col-8 dummyCol load-placeholder"></div>
            <div class="col-12 dummyCol load-placeholder"></div>
            <div class="col-12 dummyCol load-placeholder"></div>
            <div class="col-12 dummyCol load-placeholder"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostsLoader'
}
</script>

<style lang="scss" scoped>
.dummyColHead{
    height: 10px;
    margin: 2px 8px;
}
.dummyCol{
    height: 10px;
    margin: 4px 0;
}
</style>