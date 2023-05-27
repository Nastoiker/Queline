<template>



        <div class="relative w-full min-h-[100vh]  ">
            <div class="bg-green borderRadius absolute  right-0 m-0  w-[941px] h-[941px]">        </div>

            <div class="relative w-full w-full">
                    <div class="dots absolute sm:right-[200px] z-10 top-0">
                    </div>
                </div>
            <div class="sm:flex justify-between w-full">
                <h1 class=" my-auto double-line-shadow text-5xl">Популярное</h1>
                <div class="w-1/2 z-50">
                    <iframe width="full" height="300" src="https://www.youtube.com/embed/yBp5mXHxY94" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                    <div>

                    </div>
                </div>
            </div>
            <button>Подробнее</button>
            </div>


</template>
<style scoped>
.double-line-shadow{
    color: rgba(43, 47, 47, 0.7);
    text-shadow: 200px -20px 1px rgba(202, 139, 104, 0.6);
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
