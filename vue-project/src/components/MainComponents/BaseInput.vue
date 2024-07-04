<script setup>
import { defineEmits, defineProps } from "vue";

const props = defineProps(["label", "modelValue", "placeholder", "type"]);
const emit = defineEmits(["update:modelValue"]);

const emitUpdate = (event) => {
  emit("update:modelValue", event.target.value);
};
</script>
<template>
  <div id="input" class="flex flex-col w-full">
    <label
      for="username"
      class="font-semibold text-sm text-gray-600 pb-1 block"
      >{{ label }}</label
    >
    <input
      :placeholder="placeholder"
      :value="modelValue"
      @input="emitUpdate"
      :type="type"
      class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"
      autocomplete="off"
      style="transition: border-color 0.3s ease-in-out"
    />
  </div>
</template>
