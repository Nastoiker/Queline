<script setup>
const props = defineProps({categories: Array});
import CategoryesComponent from "@/components/Category/CategoryesComponent.vue";
import { ref } from 'vue'
// const some = ref([{title: 'asdasdasd'},{title: 'asdasdasd'},{title: 'asdasdasd'},{title: 'asdasdasd'},{title: 'asdasdasd'}]);

</script>

<style>
@import url('keen-slider/keen-slider.css');
</style>
<script>
import { useKeenSlider } from 'keen-slider/vue'
import { ref } from 'vue'

export default {
    setup(){
        const someasdasd = ref([{title: 'asdasdasd'},{title: 'asdasdasd'},{title: 'asdasdasd'},{title: 'asdasdasd'},{title: 'asdasdasd'}]);
        const opacities = ref([])
        const [container] = useKeenSlider({

            slides: this.props.categories.length,
            detailsChanged: (s) => {
                opacities.value = s.track.details.slides.map((slide) => slide.portion)
            },
        })
        return { container, someasdasd, opacities }
    }
}
</script>

<template>
    <div>
        Категории
        <div ref="container" class="keen-slider">
            <div  v-for="(c,index) of props.categories"  class="keen-slider__slide" :key="index" >

                    <!--        <img :src="category.photo" alt="">-->
                <div>

                    <div class="w-10 h-10 bg-white">
                    </div>
                    <h1>sadasd</h1>
                    <h1 >{{c.title}}</h1>
                </div>
                <!--            <CategoryesComponent class="keen-slider__slide" :category="c"/>-->
            </div>
        </div>

    </div>

</template>
