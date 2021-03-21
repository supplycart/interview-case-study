<template>
  <div>
    <input
      type="button"
      :value="showForm ? '< Back' : 'Register'"
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
      <br />
      <input type="submit" value="Register" />
    </form>
    <label>{{ message }}</label>
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
        "email": this.email,
        "password": this.password,
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
            "product": [],
            "price": [],
            "id": userId
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
