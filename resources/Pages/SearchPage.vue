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
            <button
                class="tab-button"
                :class="{ active: activeTab === 'category' }"
                @click="setActiveTab('category')"
            >
                Категории
            </button>
        </div>
        <div class="tab-content">
            <div v-show="activeTab === 'video'">
                <h2>Видео</h2>
                <!-- Ваш контент для вкладки видео -->
            </div>
            <div v-show="activeTab === 'users'">
                <h2>Пользователи</h2>
                <!-- Ваш контент для вкладки пользователи -->
            </div>
            <div v-show="activeTab === 'category'">
                <h2>Категории</h2>
                <!-- Ваш контент для вкладки категории -->
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
const searchStore = useSearchStore();
const { search, finded } = storeToRefs(searchStore);
</script>
