<template>
    <div class="max-w-[400px] border-2 border-white rounded my-2 ">
        <div class="flex max-w-[400px] flex-wrap">
            <CreateTag
                v-for="tag in tags"
                :text="tag.text"
                :id="tag.id"
                @deleteTag="deleteTag"
            />
        </div>
        <input
            type="text"
            class="w-full bg-transparent p-2 outline-none"
            placeholder="Введите тэг"
            @keydown="pushTag"
        >
    </div>
</template>

<script setup>
import CreateTag from '@/components/createVideo/CreateTag.vue';
import {ref} from "vue";

const tags = ref([]);
const counter = ref(0);

const emits = defineEmits([
    'updateTags'
])
const pushTag = ($e) => {
    if ($e.keyCode === 13) {
        $e.preventDefault();
        tags.value.push({
            'id': counter.value,
            'text': $e.target.value
        });
        $e.target.value = '';
        counter.value++;
        emits('updateTags', tags.value.map(t => t.text));
    }
}

const deleteTag = (id) => {
    tags.value = tags.value.filter(t => t.id !== id)
}

</script>

<style scoped>

</style>
