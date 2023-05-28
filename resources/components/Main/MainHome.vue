<template>



        <div class="relative w-full min-h-[100vh]  ">
            <div class="bg-green borderRadius absolute  right-0 m-0  w-[941px] h-[941px]">        </div>

                    <div class="dots absolute sm:right-[200px] z-10 top-0">
                    </div>
            <button></button>

            <div class="flex flex-wrap   my-48 sm:justify-around w-full">
                <h1 class=" my-auto double-line-shadow text-7xl z-30">Популярное</h1>
                <div class="w-1/3 h-96 z-40">

                        <video class=" min-w-[400px]" controls="controls" :src="videoGame"></video>
                        <h1>Здесь геншин</h1>

                </div>


            </div>
        </div>


</template>
<script setup>
import videoGame from '@/assets/game.mp4';
</script>
<style scoped>
.double-line-shadow{
    text-shadow: 200px -50px 1px rgba(255, 255, 255, 0.1);
}
.borderRadius {
    border-radius: 100% ;
    margin-top: -500px;
    margin-right: -600px;

    /*z-index: 100000000000000000000000;*/
}

.dots {
    min-width: 100px;
    width: 416px;
    height: 419.29px;
    min-height: 100px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='20' width='20'%3E%3Ccircle cx='10' cy='10' r='5' fill='%23e0e0e0' /%3E%3C/svg%3E ");
}
</style>
