<template>
    <div class="mx-4 w-11/12">
        <form method="post" @submit.prevent="$emit('sendComment', mainTextArea.value)" class="w-full">
            <textarea
                placeholder="Введите комментарий"
                class="w-full h-8 border-b-white bg-transparent resize-none outline-none border-b-2"
                @input="textAreaLengthChecker"
                ref="mainTextArea"
            ></textarea>
            <div
                v-if="isFilled"
                class="flex justify-end mt-3"
            >
                <button
                    class="mr-3"
                    @click="focusOut"
                >Отмена</button>
                <button
                    type="submit"
                >Оставить комментарий</button>
            </div>
        </form>

    </div>
</template>
<script setup>
import {ref} from "vue";

const mainTextArea = ref(null);
const isFilled = ref(false);

const textAreaLengthChecker = () => {
    isFilled.value = mainTextArea.value.value.length > 0;
}

const focusOut = () => {
    mainTextArea.value.value = '';
    isFilled.value = false;
    mainTextArea.value.blur();
}

</script>
