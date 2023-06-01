<template>
    <div class="main" @dragover="dragover" @dragleave="dragleave" @drop="drop">
        <div class="dropzone-container">
            <svg width="76" class="mx-auto" height="75" viewBox="0 0 76 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_143_1106)">
                    <path opacity="0.984" fill-rule="evenodd" clip-rule="evenodd" d="M34.9571 -0.0732422C36.9362 -0.0732422 38.9155 -0.0732422 40.8946 -0.0732422C42.0668 0.426186 42.7842 1.30509 43.0469 2.56348C43.0964 15.7958 43.1459 29.0284 43.1954 42.2607C46.8321 38.6719 50.4688 35.083 54.1055 31.4941C55.4556 30.7774 56.7419 30.8751 57.9649 31.7871C59.2863 32.993 60.4986 34.287 61.6016 35.6689C61.9631 36.7402 61.8642 37.7656 61.3048 38.7451C54.155 45.8008 47.0053 52.8564 39.8555 59.9121C38.4834 60.8064 37.1474 60.7575 35.8477 59.7656C28.7969 52.8076 21.7462 45.8496 14.6954 38.8916C13.8857 37.696 13.8362 36.4752 14.5469 35.2295C15.7646 33.7837 17.1251 32.4898 18.629 31.3477C19.9747 30.8415 21.2118 31.037 22.3399 31.9336C25.8282 35.376 29.3165 38.8184 32.8048 42.2607C32.8542 28.833 32.9038 15.4053 32.9532 1.97754C33.352 1.02261 34.02 0.339015 34.9571 -0.0732422Z" fill="black"/>
                    <path opacity="0.986" fill-rule="evenodd" clip-rule="evenodd" d="M66.2773 74.9267C47.3764 74.9267 28.4752 74.9267 9.57422 74.9267C8.64994 74.5761 7.98197 73.9412 7.57031 73.0224C7.27344 70.9717 7.27344 68.9209 7.57031 66.8701C7.89193 65.9667 8.51041 65.3565 9.42578 65.0391C18.9452 64.8694 28.47 64.7962 38 64.8193C47.4817 64.7959 56.957 64.8691 66.4258 65.0391C67.3412 65.3565 67.9596 65.9667 68.2812 66.8701C68.513 68.6697 68.5624 70.4763 68.4297 72.29C68.1656 73.5507 67.4482 74.4296 66.2773 74.9267Z" fill="black"/>
                </g>
                <defs>
                    <clipPath id="clip0_143_1106">
                        <rect width="76" height="75" fill="white"/>
                    </clipPath>
                </defs>
            </svg>

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
