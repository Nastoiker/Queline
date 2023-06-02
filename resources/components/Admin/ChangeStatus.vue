<template>
    <div>
        <div>
            <button class="rounded-md hover:scale-110 px-5 transition-all py-2 border" @click="toggle">Изменить доступность</button>
            <div class="flex flex-col space-y-2" v-if="this.open">
                <button @click="this.setModerated(1)" class="rounded-md hover:scale-110 transition-all px-5 py-2 bg-green">Нет ограничений</button>
                <button @click="this.setModerated(2)" class="rounded-md hover:scale-110 transition-all px-5 py-2 bg-green">Нарушение</button>
                <button @click="this.setModerated(3)" class="rounded-md hover:scale-110 transition-all px-5 py-2 bg-green">Теневой  бан</button>
                <button @click="this.setModerated(4)" class="rounded-md hover:scale-110 transition-all px-5 py-2 bg-green">Бан</button>
            </div>
        </div>
        <div v-if="this.status===1">
            <h1>
                Нет Ограничений
            </h1>
        </div>
        <div v-if="this.status===2">
            <h1>
                Нарушение
            </h1>
        </div>
        <div v-if="this.status===3">
            <h1>
                Теневой бан
            </h1>
        </div>
        <div v-if="this.status===4">
            <h1>
                Бан
            </h1>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        id: String,
        show: Boolean,
        statusvideo: Number,
    },
    data() {
        return {
            open: this.show,
            status: this.statusvideo,
            idVideo: this.id
        }
    },
    methods: {
        toggle() {
            this.open = !this.open;
        },
        setModerated(status)  {
            this.status = status;
            this.open = false;
            this.$emit('ChangeStatus',  this.idVideo, status )
        },
    }
}

</script>
