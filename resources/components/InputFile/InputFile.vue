<template>
    <div class="main" @dragover="dragover" @dragleave="dragleave" @drop="drop">
        <div class="dropzone-container">
        <input
            class="hidden-input"
            type="file"
            accept="video/*, image/*"
            @change="onFileChange($event)"
        />
        <label  class="file-label">{{label}} </label>

        <div v-if="isDragging">Перекинь файл сюда</div>
        <div v-else>Перенеси файл сюда или <u>нажми сюда</u> чтобы загрузить.</div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    label: String,
})
</script>
<script>


export default {
    data() {
        return {
            isDragging: false,
            file: {},
        };
    },
    methods: {
        onChange() {
            this.files = this.$refs.file.files[0];
        },
        dragover(e) {
            e.preventDefault();
            this.isDragging = true;
        },
        dragleave() {
            this.isDragging = false;
        },
        drop(e) {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            const reader = new FileReader()
            reader.readAsDataURL(file)
            reader.onload = () => {
                file.previewBase64 = reader.result;
                this.$emit('file-updated',file);
            }
            console.log(file);
            this.isDragging = false;
        },
        onFileChange($event) {
            let file;
            if(!$event.target) {
                 file = $event.dataTransfer.files[0];
            } else {
                 file = $event.target.files[0]
            }
            const reader = new FileReader()
            if (file) {
                reader.readAsDataURL(file)
                reader.onload = () => {
                    // Set a new property on the captured `file` and set it to the converted base64 image
                    file.previewBase64 = reader.result
                    // Emit the file with the new previewBase64 property on it
                    this.$emit('file-updated', file)
                }
                reader.onerror = (error) => {
                    console.log('Error ', error)
                }
            }
        },
    },
}
</script>
<style scoped>
.main {
    display: flex;
    flex-grow: 1;
    align-items: center;
    height: 200px;
    justify-content: center;
    text-align: center;
}

.dropzone-container {
    padding: 4rem;
    background: #f7fafc;
    border: 1px solid #e2e8f0;
}

.hidden-input {
    opacity: 0;
    margin-top: 20px;
    overflow: hidden;
    position: absolute;
    width: 100px;
    height: 50px;
}

.file-label {
    font-size: 20px;
    display: block;
    cursor: pointer;
}

.preview-container {
    display: flex;
    margin-top: 2rem;
}

.preview-card {
    display: flex;
    border: 1px solid #a2a2a2;
    padding: 5px;
    margin-left: 5px;
}

.preview-img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    border: 1px solid #a2a2a2;
    background-color: #a2a2a2;
}
.hide-file-input {
    position: absolute;
    width: 100px;
    height: 100px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}

</style>
