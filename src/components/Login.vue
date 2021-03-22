<template>
  <div class="max-w-login text-right">
    <input
      type="button"
      :value="showForm ? '< Back' : 'Login'"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-1.5"
      @click="showForm = !showForm"
    />
    <form v-show="showForm" class="mt-2" @submit="onSubmit">
      <div class="mb-4 flex flex-row justify-between items-center">
        <label for="email-input-login">Email</label>
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
          type="password"
          class="ml-3 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
          required
        />
      </div>
      <label class="mx-2">{{ message }}</label>
      <input
        type="submit"
        value="Login"
        class="my-3.5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      />
    </form>
  </div>
</template>

<script>
export default {
  name: "Login",
  emits: ["set-token"],
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
      const loginUser = {
        email: this.email,
        password: this.password,
      };

      const res = await fetch("http://localhost:5000/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(loginUser),
      });

      const data = await res.json();
      if (typeof data == "object") {
        localStorage.setItem("token", data.accessToken);
        window.location.reload();
      } else {
        this.message = data;
      }
    },
  },
};
</script>
