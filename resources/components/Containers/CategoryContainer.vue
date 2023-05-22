<template>
    <div v-for="c of categories" :ref="container" class="keen-slider">
            <CategoryesComponent :category="c"/>
    </div>
</template>
<script setup>
defineOptions({categories: Array});
    import {useCategoryStore} from "@/js/store/categories";
    import {useKeenSlider} from "keen-slider/vue";
    import CategoryesComponent from "@/components/Category/CategoryesComponent.vue";
    // const categories = useCategoryStore();
    const container = useKeenSlider({
        loop: true,
        mode: "free",
        slides: {
            perView: 10,
            spacing: 15,
        },
    })
</script>
