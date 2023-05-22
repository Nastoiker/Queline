<template>
    <div class="relative w-full min-h-[100vh] min-w-[100vw]">
        <div>
            <h1 class="double-line-shadow">Популярное</h1>
        </div>
        <div class="bg-gray-200 borderRadius absolute right-0 w-[35vw] h-[35vw]">
        </div>
        <div class="dots absolute sm:right-[500px] z-10 sm:top-20">
        </div>
    </div>
</template>
<style scoped>
.double-line-shadow{
    color: rgba(43, 47, 47, 0.7);
    text-shadow: -20px 20px 0 rgba(202, 139, 104, 0.6);
}
.borderRadius {
    border-radius: 100% ;
    top: -200px;
    right: -90px;
    overflow: hidden;
}
.dots {
    min-width: 100px;
    width: 20vw;
    height: 20vw;
    min-height: 100px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='20' width='20'%3E%3Ccircle cx='10' cy='10' r='5' fill='%23e0e0e0' /%3E%3C/svg%3E ");
}
</style>
