<template>
    <div class="media align-items-center pb-3 pt-2" ref="media">
        <div class="border rounded-circle load-placeholder" style="height:40px; width:40px;">
        </div>
        <div class="media-body pl-2">
            <div class="row">
                <div class="col-10">
                    <div class="row">
                        <div class="col-4 dummyColHead load-placeholder"></div>
                    </div>
                </div>
                <div class="col-1">
                    <small class="dummySpan load-placeholder">
                        <!-- TA -->
                        <!-- <img class="fa-trash" src="images/garbage.png" alt="marketplace" width="19px" height="19px"> -->
                    </small>
                    <!-- <div class="col-1 dummyColHead load-placeholder"></div> -->
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4 dummyCol load-placeholder"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FriendSuggestionLoader'
}
</script>

<style scoped>
.dummySpan{
    color: transparent;
}
.dummyColHead{
    height: 12px;
    margin: 2px 12px;
}
.dummyCol{
    height: 10px;
    margin: 4px 12px;
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