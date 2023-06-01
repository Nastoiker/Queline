<template>
    <div class="relative inline-block overflow-hidden">
        <input type="file" accept="image/*" class="hidden" ref="file" @change="change">
        <img :src="src" alt="Avatar"  class="h-full w-full object-cover">
        <div class="absolute top-0 h-full w-full bg-black bg-opacity-25 flex items-center justify-center">
            <button type="button" @click="browse" class="rounded-full  bg-gray-200 bg-opacity-50 hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                <svg height="30" width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.9918 21C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918ZM20 15V5H4V19L14 9L20 15ZM20 17.8284L14 11.8284L6.82843 19H20V17.8284ZM8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11Z"></path></svg>
            </button>
            <button type="button" v-if="src!==defaultSrc" @click="remove" class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                <svg  height="30" width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"/></svg>
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        value: File,
        defaultSrc: String,
    },
    data() {
        return {
            src: this.defaultSrc,
            file: null,
            error: '',
        }
    },
    methods: {
        browse() {
            this.$refs.file.click();
        },
        remove() {
            this.file = this.defaultSrc;
            this.src = this.defaultSrc;
            this.error = '';
            this.$emit('input', null);
        },
        change(e) {
            const file = e.target.files[0];

            this.file = e.target.files[0];
            let reader = new FileReader();

            reader.readAsDataURL(this.file);

            reader.onload = (e) => {
                const image = new Image();
                const srcFile = e.target.result;
                image.src = reader.result;
                image.onload = () => {
                    const minWidth =  960;
                    const minHeight = 384;
                    const width = image.width;
                    const height = image.height;
                    if ((width < minWidth || height < minHeight) || (width/height<=3)) {
                        this.error = `Изображение должно быть не меньше,чем ${minWidth}x${minHeight}. Размер текущего изображения ${width}x${height}.`;
                        this.file = this.defaultSrc
                        this.src = this.defaultSrc;
                        this.$emit('text-updated', this.error);
                    } else {
                        // Emit the file if it meets the resolution requirements
                       this.src = srcFile;
                       this.error = '';
                        console.log(`Изображение должно быть не меньше,чем ${minWidth}x${minHeight}. Размер текущего изображения ${width}x${height}.`);
                        this.$emit('file-updated', file);
                    }
                }
            }
        }
    }
}
</script>
