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

<style scoped>
.dummyColHead{
    height: 10px;
    margin: 2px 8px;
}
.dummyCol{
    height: 10px;
    margin: 4px 0;
}

/* This is the important animation */
.load-placeholder{
  position:relative;
  overflow: hidden;
  background-image: linear-gradient(90deg, #FFFFFF, #DEDEDE, #FFFFFF);
  background-size: 60% 100%;
  background-repeat: no-repeat;
  animation: loadsimulate 1s infinite;
}

@keyframes loadsimulate{
  0%{ background-position: -140% 0; }
  100%{
    background-position: 310% 0;
  }
}

.load-placeholder:before{
  content:"";
  position: absolute;
  left:0;
  top:0;
  width: 100%;
  height: 100%;
  background-color: rgba(150, 150, 150    , 0.2);
}
</style>