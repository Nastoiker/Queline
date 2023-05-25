

<script>
import {ref, toRef, watchEffect} from "vue";
import { useKeenSlider } from "keen-slider/vue";
import "keen-slider/keen-slider.min.css";

export default {
    props: {
        categories: {
            type: Array
        }
    },

    setup(props) {
        const categoriesValue = ref(props.categories);
        const [container] = useKeenSlider({
            loop: true,
            slides: {
                perView: 'auto',
            },

            // mode: "free-snap",
        });

        return { container, categoriesValue  };
    },
};
</script>



<template>
    <div>
        <div class="keen-slider w-full" ref="container">
            <div
                class="keen-slider__slide "
                v-for="(src, idx) in categoriesValue"
                :key="idx"
            >
                <div>
                    <div class="bg-white w-10 h-10">

                    </div>
                    <h1>{{src.title}}</h1>
                </div>
            </div>
        </div>
    </div>

</template>
