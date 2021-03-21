<template>
  <div>
    <input
      type="button"
      :value="showForm ? '< Back' : 'Login'"
      @click="showForm = !showForm"
    />
    <form v-show="showForm" @submit="onSubmit">
      <input v-model="email" type="email" placeholder="Email" required />
      <br />
      <input
        v-model="password"
        type="password"
        placeholder="Password"
        required
      />
      <input type="submit" value="Login" />
    </form>
    <label>{{ message }}</label>
  </div>
</template>

<script>
export default {
  name: "Login",
  props: {
    token: {
      type: String,
      default: null,
    },
  },
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

