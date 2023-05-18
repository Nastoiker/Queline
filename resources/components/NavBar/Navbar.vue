<template>
    <div @click="closeMenu">
        <button>menu</button>
    </div>
    <div>

    </div>
</template>
<script>
export default  {
    data () {
        return {
            isOpen: true
        }
    },
    methods: {
        closeMenu () {
            this.spanVisible = !this.spanVisible
        }
    }
}
</script>
<script setup>
    import {reactive} from "vue";

    const isOpen = reactive({
        isOpen
    });
</script>
