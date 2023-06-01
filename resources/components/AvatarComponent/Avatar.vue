<template>
    <div class="relative inline-block overflow-hidden">
        <input type="file" accept="image/*" class="hidden" ref="file" @change="change">
        <img :src="src" alt="Avatar"  class="h-full w-full object-cover">
        <div class="absolute top-0 h-full w-full bg-black bg-opacity-25 flex items-center justify-center">
            <button type="button" @click="browse" class="rounded-full  bg-gray-200 bg-opacity-50 hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                <svg height="30" width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.9918 21C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918ZM20 15V5H4V19L14 9L20 15ZM20 17.8284L14 11.8284L6.82843 19H20V17.8284ZM8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11Z"></path></svg>
            </button>
            <button type="button" v-if="value" @click="remove" class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                <svg  height="30" width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.9918 21C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918ZM20 15V5H4V19L14 9L20 15ZM20 17.8284L14 11.8284L6.82843 19H20V17.8284ZM8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11Z"></path></svg>
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
            file: null
        }
    },
    methods: {
        browse() {
            this.$refs.file.click();
        },
        remove() {
            this.file = null;
            this.src = null;
            this.$emit('input', null);
        },
        change(e) {
            this.file = e.target.files[0];
            this.$emit('input', this.file);
            let reader = new FileReader();
            reader.readAsDataURL(this.file);
            reader.onload = (e) => {
                this.src = e.target.result;
            }
        }
    }
}
</script>
