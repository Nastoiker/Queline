<template>
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
                            <div>
                            <AdminChannelsContainer :channels="users" />
                        </div>


                    </div>
                    <div v-show="activeTab === 'createCategory'">
                        <div class="my-20">
                            <form   @submit.prevent="createCategory">

                                <img class="max-w-[500px]" :src="photoCategoryPreview" alt="">
                                <InputFile v-if="!photoCategory"  @file-updated="imgCategoryHandle" class="mb-20"  label="Фотография категории"/>
                                <BaseInput required class=" mx-auto w-[500px] block" label="Название категории" v-model="createCategoryModel"  />
                                <ButtonComponent class="text-center absolute left-0 right-0 mx-auto my-20">Создать категорию</ButtonComponent>
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
import ChannelsContainer from "@/components/Containers/ChannelsContainer.vue";
import AdminChannelsContainer from "@/components/Admin/AdminChannelsContainer.vue";
const adminStore = useAdminStore();
 adminStore.getVideoAll();
 adminStore.getUserAll();
const { videosForAdmin, admin, users } = storeToRefs(adminStore);

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
        title: createCategoryModel.value,
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
