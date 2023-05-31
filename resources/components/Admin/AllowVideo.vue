<template>
    <div>
        <div v-if="this.status===0">
            <h1>Не прошла модерацию</h1>
            <button @click="this.setModerated" class="rounded-md hover:scale-110 transition-all px-5 py-2 bg-green">Разрешить доступ</button>
        </div>
        <div v-else>
            <h1>
                Видео разрешено
            </h1>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        is_moderated: Number,
        id: String,
    },
    data() {
        return {
            status: this.is_moderated,
            idVideo: this.id
        }
    },
    methods: {
        setModerated()  {
            this.status = 1;
            this.$emit('moderate', this.idVideo)
        },
    }
}

</script>
