import { defineStore } from "pinia";
import { ref } from "vue";
import { useCommonStore } from "./common";
const common = useCommonStore();
import axios from "@/http/Axios";

export const useUserStore = defineStore("user", () => {
  const users = ref([]);
  const user = ref(null);
  const success = ref(null);

  async function getAllUsers() {
    try {
      const res = await axios.get(`/api/allusers`);
      users.value = res.data;
    } catch (err) {
      console.error(err);
    }
  }

  async function store(data, userState) {
    try {
      const res = await axios.post(`/api/addUser`, data);
      users.value.push(res.data);
      common.validationError = null;
      success.value = res.data.success;
      Object.keys(userState).forEach((key) => {
        userState[key] = "";
      });
    } catch (err) {
      if (err.response && err.response.status === 422) {
        console.log("Validation error");
        common.validationError = err.response.data.errors;
      } else {
        console.log("Something went wrong");
      }
    }
  }

  async function userWithId(id) {
    try {
      const res = await axios.get(`/api/userById/${id}`);
      user.value = res.data;
    } catch (err) {
      console.error(err);
    }
  }

  async function updateUser(data, id) {
    try {
      const res = await axios.post(`/api/updateUsers/${id}`, data);

      const updatedUser = res.data.user;

      // Update users array
      const index = users.value.findIndex((user) => user.id === updatedUser.id);
      if (index !== -1) {
        users.value.splice(index, 1, updatedUser);
      }

      // Handle success or reset validation errors
      console.log("User updated:", updatedUser);

      success.value = res.data.success;
      common.validationError = null;
    } catch (err) {
      if (err.response && err.response.status === 422) {
        console.log("Validation error");
        common.validationError = err.response.data.errors;
      } else {
        console.log("Something went wrong");
      }
    }
  }

  async function deleteUser(id) {
    try {
      await axios.delete(`/api/deleteUser/${id}`);
      users.value = users.value.filter((user) => user.id !== id);
    } catch (err) {
      console.error(err);
    }
  }

  return {
    updateUser,
    store,
    userWithId,
    user,
    users,
    getAllUsers,
    deleteUser,
  };
});
