<template>
    <div class="not-found-main">
        <div class="not-found-404 text-center mt-36 mb-2 leading-none">404</div>
        <div class="text-4xl text-center mt-6 mb-6">Страница не найдена</div>
        <div class="text-3xl text-center w-1/2 ml-auto mr-auto">Похоже, запрашиваемая вами страница не найдена.
            Воспользуйтесь меню нашего сайта для поиска или выхода в меню
        </div>
        <div class="round absolute w-[941px] h-[941px] rounded-full z-1"></div>
        <div class="points w-[300px] h-[300px] absolute z-1"></div>
        <div class="bottom-line-1 bottom-0 w-full h-[130px] absolute z-30 left-0"></div>
        <div class="bottom-line-2 bottom-0 w-full h-[231px] absolute z-20 left-0"></div>
    </div>
</template>

<script setup>

</script>

<style>
.not-found-404 {
    font-size: 250px;
}

.round {
    background-color: #198585;
    right: -400px;
    top: -450px;
}

.points {
    background-image: url("/resources/assets/points.svg");
    background-repeat: no-repeat;
    background-size: cover;
    top: 0;
    left: 0;
}

.bottom-line-1 {
    background-image: url("/resources/assets/Subtract.svg");
    background-repeat: no-repeat;
    background-size: cover;
}

.bottom-line-2 {
    background-image: url("/resources/assets/Subtract(1).svg");
    background-repeat: no-repeat;
    background-size: cover;
}

</style>
