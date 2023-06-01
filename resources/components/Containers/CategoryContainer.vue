<script>
import { ref, toRef, watchEffect } from "vue";
import { useKeenSlider } from "keen-slider/vue";
import "keen-slider/keen-slider.min.css";
import CategoryesComponent from "../Category/CategoryesComponent.vue";

export default {
    props: {
        categories: {
            type: Array,
        },
    },
    setup(props) {
        const categoriesValue = ref(props.categories);
        const [container] = useKeenSlider({
            loop: true,
            slides: {
                perView: "auto",
                spacing: 15,
            },
            breakpoints: {
                "(min-width: 100px)": {
                    slides: {
                        loop: false,
                        perView: 1,
                        spacing: 5,
                    },
                },
                "(min-width: 500px)": {
                    slides: {
                        loop: false,
                        perView: 3,
                        spacing: 7,
                    },
                },
                "(min-width: 1000px)": {
                    slides: {
                        loop: true,
                        perView: 6,
                        spacing: 7,
                    },
                },
                "(min-width: 1400px)": {
                    slides: {
                        perView: 7,
                        spacing: 7,
                    },
                },
            },
            // mode: "free-snap",
        });
        return { container, categoriesValue };
    },
    components: { CategoryesComponent },
};
</script>

<template>
    <div>
        <div class="keen-slider w-full" ref="container">
            <div
                class="keen-slider__slide min-w-20"
                v-for="(src, idx) in categoriesValue"
                :key="idx"
            >
                <div>
                    <CategoryesComponent :category="src" />
                </div>
            </div>
        </div>
    </div>
</template>
