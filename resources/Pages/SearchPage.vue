<template>
    <div>
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
        </div>
        {{searchValue.value}}
        <div class="tab-content">
            <div v-show="activeTab === 'video'">
                <CategoryContainer class="w-full" :categories="founded.categories" />
               <VideoContainer :videos="founded.videos"/>
                <!-- Ваш контент для вкладки видео -->
            </div>
            <div v-show="activeTab === 'users'">
                <ChannelsContainer :channels="founded.users" />
            </div>
            <div v-show="activeTab === 'category'">

            </div>
        </div>
    </div>
</template>

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
<script setup>
import { useSearchStore } from "@/js/store/search";
import { storeToRefs } from "pinia";
import {ref} from "vue";
import {useRouter} from "vue-router";
import VideoContainer from "@/components/Containers/VideoContainer.vue";
import ChannelsContainer from "@/components/Containers/ChannelsContainer.vue";
import CategoryContainer from "@/components/Containers/CategoryContainer.vue";
const router = useRouter();

const searchStore = useSearchStore();
const searchValue = ref('');
searchValue.value = router.currentRoute.value.params.value;
searchStore.getFounded(searchValue.value);
const { founded } = storeToRefs(searchStore);

</script>

