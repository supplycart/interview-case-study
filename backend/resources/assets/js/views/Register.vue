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
                        Register a new account
                    </h2>
                </div>
                <form class="mt-8 space-y-6" action="#" method="POST">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="name" class="sr-only">Name</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                v-model="name"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                                placeholder="Name"
                            />
                        </div>
                        <div>
                            <label for="email-address" class="sr-only"
                                >Email address</label
                            >
                            <input
                                id="email-address"
                                name="email"
                                type="email"
                                v-model="email"
                                autocomplete="email"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                                placeholder="Email address"
                            />
                        </div>
                        <div>
                            <label for="password" class="sr-only"
                                >Password</label
                            >
                            <input
                                id="password"
                                name="password"
                                type="password"
                                v-model="password"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                                placeholder="Password (At least 6 characters)"
                            />
                        </div>
                        <div>
                            <label for="password-confirm" class="sr-only"
                                >Confirm Password</label
                            >
                            <input
                                id="password-confirm"
                                name="password-confirm"
                                type="password"
                                v-model="password_confirmation"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                                placeholder="Confirm Password"
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
                            Register
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
    props: ["nextUrl"],
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
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

            if (this.password.length < 6) {
                // return alert("Password must be more than 6 characters");
                this.alertMessage = {
                    error: "Password must be 6 characters or more.",
                    description:
                        "Please check you password and try again."
                };
                this.showAlert = true;
            } else {
                if (
                    this.password !== this.password_confirmation ||
                    this.password.length <= 0
                ) {
                    this.password_confirmation = "";
                    this.alertMessage = {
                    error: "Passwords do not match.",
                    description:
                        "Please check you confirmation password and try again."
                };
                this.showAlert = true;
                }
            }
            let name = this.name;
            let email = this.email;
            let password = this.password;
            let c_password = this.password_confirmation;
            axios
                .post("api/register", { name, email, password, c_password })
                .then(response => {
                    let data = response.data;
                    localStorage.setItem(
                        "bigStore.user",
                        JSON.stringify(data.user)
                    );
                    localStorage.setItem("bigStore.jwt", data.token);
                    if (localStorage.getItem("bigStore.jwt") != null) {
                        this.$emit("loggedIn");
                        let nextUrl = this.$route.params.nextUrl;
                        this.$router.push(nextUrl != null ? nextUrl : "/");
                    }
                });
        }
    }
};
</script>
