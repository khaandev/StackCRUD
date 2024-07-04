import { defineStore } from "pinia";
import { ref } from "vue";

export const useCommonStore = defineStore("common", () => {
  const validationError = ref(null);

  return {
    validationError,
  };
});
