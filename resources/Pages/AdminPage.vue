<template>
    <router-link to="Home" name="Home"></router-link>
                <div class="tabs">
                    <button
                        class="tab-button"
                        :class="{ active: activeTab === 'video' }"
                        @click="setActiveTab('video')"
                    >
                        Видео
                    </button>
                    <button
                        class="tab-button"
                        :class="{ active: activeTab === 'users' }"
                        @click="setActiveTab('users')"
                    >
                        Пользователи
                    </button>
                    <button
                        class="tab-button"
                        :class="{ active: activeTab === 'createCategory' }"
                        @click="setActiveTab('createCategory')"
                    >
                        Создание категории
                    </button>
                </div>
                <div class="tab-content">
                    <div v-show="activeTab === 'video'">
                     <AdminVideoContainer :videos="videosForAdmin" />

                    </div>
                    <div v-show="activeTab === 'users'">
                        <h2>Пользователи</h2>
                        <!-- Ваш контент для вкладки пользователи -->
                    </div>
                    <div v-show="activeTab === 'createCategory'">
                        <div class="tex-tstart">
                            <form   @submit.prevent="createCategory">

                                <img :src="photoCategory" alt="">
                                <InputFile v-if="!photoCategory"  @file-updated="imgCategoryHandle" class="mb-20"  label="Фотография категории"/>
                                <BaseInput required class=" mx-auto w-[500px] block" label="Название категории" v-model="createCategoryModel"  />
                                <ButtonComponent class="text-center mx-auto">Создать категорию</ButtonComponent>
                            </form>
                        </div>
                    </div>
                </div>
</template>
<script setup>

import { useSearchStore } from "@/js/store/search";
import { storeToRefs } from "pinia";
import {useAdminStore} from "@/js/store/admin.js";
import BaseInput from "@/components/Input/BaseInput.vue";
import InputFile from "@/components/InputFile/InputFile.vue";
import ButtonComponent from "@/components/Button/ButtonComponent.vue";

import {ref} from "vue";
import AdminVideoContainer from "@/components/Admin/AdminVideoContainer.vue";
const adminStore = useAdminStore();
await adminStore.getVideoAll();
const { videosForAdmin, admin } = storeToRefs(adminStore);

const createCategoryModel = ref("");
const photoCategory = ref();
const photoCategoryPreview = ref({});
function imgCategoryHandle(file) {
    // videoFile.value = file.target.files;
    photoCategory.value = file;
    photoCategoryPreview.value = file.previewBase64;
}
const createCategory = async () => {
    await adminStore.createCategoy({
        text: createCategoryModel.value,
        photo: photoCategory.value,
    })
}
</script>


<script>
export default {
    data() {
        return {
            activeTab: "video",
        };
    },
    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
        },
    },
};
</script>
<style scoped>
.tabs {
    display: flex;
}

.tab-button {
    padding: 10px;
    cursor: pointer;
    border: none;
    background: #f5f5f5;
    color: #333;
    font-weight: bold;
    border-radius: 5px 5px 0 0;
    margin-right: 10px;
    transition: background-color 0.2s ease-in-out;
}

.tab-button.active {
    background-color: #333;
    color: #fff;
}

.tab-content {
    border: 2px solid #333;
    padding: 20px;
    border-radius: 0 5px 5px 5px;
}
</style>
