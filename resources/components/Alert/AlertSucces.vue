<template>
    <transition name="slide-up">
        <div v-if="show" class="success-alert">
            <div class="success-message">
                <span>Вы успешно авторизовались!</span>
            </div>
            <div class="close-btn-wrapper">
                <button @click="dismiss" class="close-btn">&#x2716;</button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            show: false
        }
    },
    methods: {
        dismiss() {
            this.show = false
        }
    }
}
</script>

<style scoped>
.success-alert {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
}

.success-message {
    background-color: #06d6a0;
    color: #fff;
    padding: 0.8rem 1rem;
    border-radius: 0.5rem 0.5rem 0 0;
    font-size: 1.2rem;
}

.close-btn {
    background-color: transparent;
    color: #fff;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
}

.close-btn:focus {
    outline: none;
}

.close-btn-wrapper {
    text-align: right;
    padding: 0.5rem 1rem;
}
</style>
