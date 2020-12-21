<template>
  <div class="bg-gray-200">
    <div
      class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
    >
      <div class="max-w-md w-full space-y-8">
        <div>
          <img
            class="mx-auto h-12 w-auto"
            src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
            alt="Workflow"
          />
          <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Sign in to your account
          </h2>
        </div>
        <form class="mt-8 space-y-6" @submit.prevent="pressed">
          <div class="rounded-md shadow-sm -space-y-px">
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input
                id="email-address"
                name="email"
                type="email"
                autocomplete="email"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Email address"
                v-model="email"
              />
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Password"
                v-model="password"
              />
            </div>
          </div>

          <div>
            <button
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              @click="pressed"
            >
              Sign in
            </button>
          </div>
        </form>
        <div class="text-red-500 text-center" v-if="error">
          {{ error.message }}
        </div>

        <div>
          <NuxtLink to="/sign-up">
            <button
              class="group relative w-full flex justify-center py-2 px-4 text-sm font-medium border-transparent focus:outline-none text-indigo-600 hover:text-indigo-500"
            >
              Register New Account?
            </button>
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import firebase from "firebase/app";
import "firebase/auth";
import Cookies from "js-cookie";

export default {
  mounted() {
    this.setupFirebase();
  },
  data: () => ({
    email: "",
    password: "",
    error: "",
  }),
  methods: {
    pressed() {
      firebase
        .auth()
        .signInWithEmailAndPassword(this.email, this.password)
        .then((data) => {
          console.log(JSON.stringify(data));
          this.$router.push("/home");
        })
        .catch((error) => (this.error = error));

      Cookies.set("email", this.email.replace(".", ""));
      console.log(this.email.replace(".", ""));
    },
    setupFirebase() {
      firebase.auth().onAuthStateChanged((user) => {
        if (user) {
          console.log("logged in");
          firebase
            .auth()
            .currentUser.getIdToken(true)
            .then((token) => {
              Cookies.set("asset_token", token);
            });
        } else {
          console.log("logged keluar");
          Cookies.remove("asset_token");
        }
      });
    },
  },
};
</script>