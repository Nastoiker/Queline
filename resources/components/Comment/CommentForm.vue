<template>
    <div class="mx-4 w-11/12">
        <form method="post" @submit.prevent="handlePushComment" class="w-full">
            <textarea
                placeholder="Введите комментарий"
                class="w-full h-fit border-b-white bg-transparent resize-none outline-none border-b-2"
                @input="textAreaLengthChecker"
                @keydown="handleKeyDown"
                ref="mainTextArea"
                :rows="counter"
            ></textarea>
            <div
                v-if="isFilled"
                class="flex justify-end mt-3"
            >
                <button
                    class="mr-3"
                    @click="focusOut"
                >Отмена
                </button>
                <button
                    type="submit"
                >Оставить комментарий
                </button>
            </div>
        </form>

    </div>
</template>
<script setup>
import {ref} from "vue";

const mainTextArea = ref(null);
const isFilled = ref(false);
const counter = ref(0);

const emits = defineEmits([
    'sendComment'
]);

const textAreaLengthChecker = () => {
    isFilled.value = mainTextArea.value.value.length > 0;
}

const handleKeyDown = ($e) => {

    if (($e.shiftKey) && ($e.keyCode === 13)) {
        $e.preventDefault();
        console.log('shift')
        mainTextArea.value.value += '\n';
        counter.value++;
    } else if ($e.keyCode === 13) {
        $e.preventDefault();
        emits('sendComment', mainTextArea.value.value);
        mainTextArea.value.value = '';
        counter.value = 0;
    }
}

const handlePushComment = () => {
    emits('sendComment', mainTextArea.value.value);
    mainTextArea.value.value = '';
};

const focusOut = () => {
    mainTextArea.value.value = '';
    isFilled.value = false;
    counter.value = 0;
    mainTextArea.value.blur();
}

</script>
