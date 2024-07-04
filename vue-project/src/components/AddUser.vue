<template>
  <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
    <h1 class="font-bold text-center text-2xl mb-5">Add User</h1>
    <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
      <form @submit.prevent="submit">
        <div class="px-5 py-7">
          <BaseInput label="Name" type="text" v-model="form.name" />
          <ValidationError field="name" />

          <BaseInput label="Phone" type="number" v-model="form.phone" />
          <ValidationError field="phone" />

          <BaseInput label="Email" type="email" v-model="form.email" />
          <ValidationError field="email" />

          <BaseInput label="Uplode Image " type="file" @change="imageChnage" />
          <ValidationError field="image" />

          <button
            type="submit"
            class="transition duration-200 bg-indigo-500 hover:bg-indigo-600 focus:bg-indigo-700 focus:shadow-sm focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block"
          >
            <span class="inline-block mr-2">Add</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import BaseInput from "@/components/MainComponents/BaseInput.vue";
import { reactive } from "vue";
import { useUserStore } from "@/stores/counter";
import ValidationError from "@/components/MainComponents/ValidationError.vue";
const user = useUserStore();
const form = reactive({
  name: "",
  phone: "",
  email: "",
  image: null,
});
function imageChnage(event) {
  const file = event.target.files[0];
  form.image = file;
}

// function submit() {
//   const data = {
//     name: form.name,
//     email: form.email,
//     phone: form.phone,
//     image: form.image,
//   };

//   user.store(data);
// }

async function submit() {
  const formData = new FormData();
  formData.append("name", form.name);
  formData.append("phone", form.phone);
  formData.append("email", form.email);
  formData.append("image", form.image);

  await user.store(formData,form);
}
</script>
