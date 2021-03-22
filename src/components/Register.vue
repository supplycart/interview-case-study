<template>
  <div class="max-w-login text-right">
    <input
      type="button"
      :value="showForm ? '< Back' : 'Register'"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-1.5"
      @click="showForm = !showForm"
    />
    <form v-show="showForm" class="mt-2" @submit="onSubmit">
      <div class="mb-4 flex flex-row justify-between items-center">
        <label for="email-input-register">Email</label>
        <input
          v-model="email"
          class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
          type="email"
          required
        />
      </div>
      <div class="flex flex-row justify-between items-center">
        <label for="email-input-password">Password</label>
        <input
          v-model="password"
          class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
          type="password"
          required
        />
      </div>
      <label class="mx-2">{{ message }}</label>
      <input
        type="submit"
        class="my-3.5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        value="Register"
      />
    </form>
  </div>
</template>

<script>
import jwt_decode from "jwt-decode";

export default {
  name: "Register",
  emits: ["register"],
  data() {
    return {
      email: "",
      password: "",
      showForm: false,
      message: "",
    };
  },
  methods: {
    async onSubmit(e) {
      e.preventDefault();
      const newUser = {
        email: this.email,
        password: this.password,
      };

      const res = await fetch("http://localhost:5000/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(newUser),
      });

      const data = await res.json();
      console.log(data);

      this.email = "";
      this.password = "";
      if (typeof data == "object") {
        const userId = jwt_decode(data.accessToken).sub;
        await fetch("http://localhost:5000/carts", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            product: [],
            price: [],
            id: userId,
            userId: userId,
          }),
        });

        await fetch("http://localhost:5000/orderHistory", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            product: [],
            id: userId,
            userId: userId,
          }),
        });

        this.message = "Successfully registered";
      } else {
        this.message = data;
      }
    },
  },
};
</script>
