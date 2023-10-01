<template>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img
                class="mx-auto h-10 w-auto"
                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                alt="Your Company"
            />
            <h2
                class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
            >
                <template v-if="mode === 'login'">
                    Sign in to your account
                </template>
                <template v-else> Create your account </template>
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form
                class="space-y-6"
                action="#"
                method="POST"
                @submit.prevent="submitForm()"
            >
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Email address</label
                    >
                    <div class="mt-2">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            v-model="loginForm.email"
                            :disabled="loginLoading"
                            required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        />
                    </div>
                    <div v-if="formError && formError.email">
                        <ul class="text-red-500 text-sm list-disc pl-5">
                            <li
                                v-for="(err, errIndex) of formError.email"
                                :key="'error' + errIndex"
                                v-text="err"
                            ></li>
                        </ul>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label
                            for="password"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Password</label
                        >
                    </div>
                    <div class="mt-2">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            v-model="loginForm.password"
                            :disabled="loginLoading"
                            required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        />
                    </div>
                    <div v-if="formError && formError.password">
                        <ul class="text-red-500 text-sm list-disc pl-5">
                            <li
                                v-for="(err, errIndex) of formError.password"
                                :key="'error' + errIndex"
                                v-text="err"
                            ></li>
                        </ul>
                    </div>
                </div>

                <div v-if="mode === 'register'">
                    <div class="flex items-center justify-between">
                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Confirm Password</label
                        >
                    </div>
                    <div class="mt-2">
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            v-model="loginForm.password_confirmation"
                            required
                            :disabled="loginLoading"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        />
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        :disabled="loginLoading"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        <svg
                            v-if="loginLoading"
                            aria-hidden="true"
                            role="status"
                            class="inline w-4 h-4 mr-3 text-white animate-spin self-center"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB"
                            />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor"
                            />
                        </svg>
                        <template v-if="mode === 'login'"> Sign in </template>
                        <template v-else> Register </template>
                    </button>
                </div>
            </form>

            <p
                class="mt-10 text-center text-sm text-gray-500"
                v-if="mode === 'login'"
            >
                Not a member?
                <a
                    href="javascript:void(0)"
                    @click="toggleMode()"
                    class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
                    :disabled="loginLoading"
                    >Register now!</a
                >
            </p>
            <p class="mt-10 text-center text-sm text-gray-500" v-else>
                Registered?
                <a
                    href="javascript:void(0)"
                    @click="toggleMode()"
                    class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
                    :disabled="loginLoading"
                    >Login now!</a
                >
            </p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export default {
    components: {},
    data() {
        return {
            mode: "login",

            loginForm: {
                email: "",
                password: "",
                password_confirmation: "",
            },
            loginLoading: false,

            dialogOpen: false,

            formError: null,
        };
    },
    methods: {
        toggleMode(specificMode) {
            this.loginForm.email = "";
            this.loginForm.password = "";
            this.loginForm.password_confirmation = "";
            this.loginLoading = false;
            this.formError = null;

            if (specificMode) {
                this.mode = specificMode;
            } else {
                this.mode = this.mode == "login" ? "register" : "login";
            }
        },
        submitForm() {
            if (this.mode == "login") {
                this.login();
            } else {
                this.register();
            }
        },
        login() {
            this.loginLoading = true;
            this.formError = null;
            axios
                .post(this.PROJECT_PATH + "login", this.loginForm)
                .then((resp) => {
                    localStorage.setItem("case-study-token", resp.data.token);
                    window.location.href = this.PROJECT_PATH + "home";
                })
                .catch((err) => {
                    if (422 == err.response.status) {
                        this.formError = err.response.data.errors;
                    }
                    this.loginLoading = false;
                });
        },
        register() {
            this.loginLoading = true;
            this.formError = null;
            axios
                .post(this.PROJECT_PATH + "register", this.loginForm)
                .then(() => {
                    this.loginLoading = false;

                    toast.success("Register successfully", {
                        position: toast.POSITION.TOP_RIGHT,
                        autoClose: 2000,
                    });

                    this.toggleMode("login");
                })
                .catch((err) => {
                    if (422 == err.response.status) {
                        this.formError = err.response.data.errors;
                    }
                    this.loginLoading = false;
                });
        },

        closeModal() {
            this.dialogOpen = false;
        },
    },
};
</script>