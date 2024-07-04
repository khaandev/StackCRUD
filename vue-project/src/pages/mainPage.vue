<script setup>
import { ref } from "vue";
import MainContant from "../components/MainContant.vue";
import AddUser from "@/components/AddUser.vue";
const toggle = ref(false);

function clickToggle() {
  toggle.value = !toggle.value;
}
</script>

<template>
  <div class="flex justify-end shadow-md p-3">
    <button
      class="text-white rounded bg-indigo-600 py-2 px-4"
      @click="clickToggle"
    >
      {{ toggle ? "Back to users" : " Add user" }}
    </button>
  </div>

  <div class="container mx-auto ">
    <AddUser v-if="toggle" />
    <MainContant v-else />
  </div>
</template>
