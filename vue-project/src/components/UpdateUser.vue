<script setup>
import { defineEmits, onMounted } from "vue";
import { reactive } from "vue";
import { useUserStore } from "@/stores/counter";
import BaseInput from "@/components/MainComponents/BaseInput.vue";
import ValidationError from "@/components/MainComponents/ValidationError.vue";

const emit = defineEmits(["cancleForm"]);
const props = defineProps(["selectedId"]);
const User = useUserStore();

const form = reactive({
  name: "",
  phone: "",
  email: "",
  image: null,
});

const cancelBtn = () => {
  emit("cancleForm");
};

function imageChnage(event) {
  const file = event.target.files[0];
  form.image = file;
}

async function submit() {
  const formData = new FormData();
  formData.append("name", form.name);
  formData.append("phone", form.phone);
  formData.append("email", form.email);
  formData.append("image", form.image);
  formData.append("_method", "PUT");

  await User.updateUser(formData, props.selectedId);
}

onMounted(async () => {
  await User.userWithId(props.selectedId);
  form.name = User.user?.name;
  form.phone = User.user?.phone;
  form.email = User.user?.email;
});
</script>

<template>
  <div
    class="faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50"
  >
    <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div
      class="md:w-[50%] w-full mx-auto max-h-[90vh] relative rounded-xl shadow-lg bg-gray-100 overflow-y-auto"
    >
      <div class="p-10">
        <button
          class="text-white text-2xl bg-red-500 py-2 px-4 rounded"
          @click="cancelBtn"
        >
          x
        </button>
        <h1 class="font-bold text-center text-2xl mb-5">Update User User</h1>
        <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
          <form @submit.prevent="submit">
            <div class="px-5 py-7">
              <BaseInput label="Name" type="text" v-model="form.name" />
              <ValidationError field="name" />
              <BaseInput label="Phone" type="number" v-model="form.phone" />
              <ValidationError field="phone" />
              <BaseInput label="Email" type="email" v-model="form.email" />
              <ValidationError field="email" />
              <BaseInput
                label="Upload Image"
                type="file"
                @change="imageChnage"
              />
              <ValidationError field="image" />
              <button
                type="submit"
                class="transition duration-200 bg-indigo-500 hover:bg-indigo-600 focus:bg-indigo-700 focus:shadow-sm focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block"
              >
                <span class="inline-block mr-2">Update</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
