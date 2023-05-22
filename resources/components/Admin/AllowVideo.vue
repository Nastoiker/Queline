<template>
    <div>
        <div>
            <div>
                <button @click="activeTab='videoAllow'">Заявки на видео</button>
                <button @click="activeTab='videoAllow'">Пользователи</button>
            </div>
            <div>
                <div v-show="activeTab=== 'videoAllow'">

                </div>
                <div v-show="activeTab=== 'users'">

                </div>
            </div>
        </div>

    </div>

</template>
<script>
export default {
    data({}) {
        return {
            activeTab: 'videoAllow'
        }
    }
}
</script>
