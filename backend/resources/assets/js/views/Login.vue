<template>
    <div class="container">
        <alert
            @close="closeAlert"
            :message="alertMessage"
            v-show="showAlert"
        ></alert>
        <div class="flex justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img
                        class="mx-auto h-12 w-auto"
                        src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Circle-icons-trends.svg"
                        alt="Workflow"
                    />
                    <h2
                        class="mt-6 text-center text-3xl font-extrabold text-gray-900"
                    >
                        Log in to your account
                    </h2>
                </div>
                <form class="mt-8 space-y-6" action="#" method="POST">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email-address" class="sr-only"
                                >Email address</label
                            >
                            <input
                                id="email"
                                type="email"
                                v-model="email"
                                name="email"
                                autocomplete="email"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                                placeholder="Email address"
                            />
                        </div>
                        <div>
                            <label for="password" class="sr-only"
                                >Password</label
                            >
                            <input
                                id="password"
                                type="password"
                                v-model="password"
                                name="password"
                                autocomplete="current-password"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                                placeholder="Password"
                            />
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            @click="handleSubmit"
                        >
                            <span
                                class="absolute left-0 inset-y-0 flex items-center pl-3"
                            >
                                <svg
                                    class="h-5 w-5 text-green-500 group-hover:text-green-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Alert from "./Alert";

export default {
    data() {
        return {
            email: "",
            password: "",
            showAlert: false,
            alertMessage: null
        };
    },
    components: { Alert },
    methods: {
        closeAlert(message) {
            this.showAlert = false;
        },
        handleSubmit(e) {
            e.preventDefault();
            if (this.password.length > 0) {
                let email = this.email;
                let password = this.password;

                axios
                    .post("api/login", { email, password })
                    .then(response => {
                        let user = response.data.user;
                        let is_admin = user.is_admin;

                        localStorage.setItem(
                            "bigStore.user",
                            JSON.stringify(user)
                        );
                        localStorage.setItem(
                            "bigStore.jwt",
                            response.data.token
                        );

                        if (localStorage.getItem("bigStore.jwt") != null) {
                            this.$emit("loggedIn");
                            if (this.$route.params.nextUrl != null) {
                                this.$router.push(this.$route.params.nextUrl);
                            } else {
                                this.$router.push(
                                    is_admin == 1 ? "admin" : "dashboard"
                                );
                            }
                        }
                    })
                    .catch(error => {
                        if (error.response) {
                            if (error.response.status === 401) {
                                this.alertMessage = {
                                    error: "Unathorized User.",
                                    description:
                                        "Please check you login credentials and try again."
                                };
                                this.showAlert = true;
                            }
                        } else if (error.request) {
                            // The request was made but no response was received
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.log("Error", error.message);
                        }
                    });
            }
        }
    }
};
</script>
