import {defineStore} from "pinia";
import {ref} from "vue";

export const useCategoryStore = defineStore("categoriesStore", {
    state: () => ({
        Categories: ref({}),
        CurrentCategories: ref({}),
    }),
    actions: {
        async getAllCategory(search) {
            const res = await axios.get();
        }
    }
})
