<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 external">
        <div class="bg-white px-6 py-12 rounded shadow">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto" src="/images/logo.webp" alt="Workflow" />
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
                </div>
                <div class="text-center text-red-500">
                    {{error ? "Incorrect Email or Password" : ""}}
                </div>
                <form class="mt-8 space-y-6">
                    <input type="hidden" name="remember" value="true" />
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address" v-model="email" name="email" type="email" autocomplete="email" required="" class="form__input appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Email address"
                                   :class="v$.email.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'"/>
                        </div>
                        <div class="relative">
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" v-model="password" :type="show ? 'text':'password'" autocomplete="current-password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Password"
                                   :class="v$.password.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'">
                            <span class="absolute inset-y-0 right-0 mr-5 text-sm leading-5 flex eye text-blue-600 hover:text-blue-500">
                                <button type="button" @click="show = !show">
                                    <EyeIcon v-if="!show" class="h-5 w-5" aria-hidden="true"/>
                                    <EyeOffIcon v-else class="h-5 w-5" aria-hidden="true"/>
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" v-model="rememberMe"/>
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
                        </div>

                    </div>

                    <div>
                        <button type="button" @click="login()"
                                class="group relative button"
                                :disabled="loading">
                            <Spinner class="w-5 h-5 fill-blue-400" v-if="loading"/>
                            <span v-else>Sign in</span>
                        </button>
                        <router-link to="/register">
                            <button type="button" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mt-4">
                                Register
                            </button>
                        </router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { LockClosedIcon, EyeIcon, EyeOffIcon } from '@heroicons/vue/solid'
import useVuelidate from "@vuelidate/core";
import {email, required} from "@vuelidate/validators";
import Spinner from "./components/Spinner";

export default {
    name: "Login",
    components: {LockClosedIcon, EyeIcon, EyeOffIcon, Spinner},
    setup () {
        return { v$: useVuelidate() }
    },
    data() {
        return {
            email: "",
            password: "",
            show: false,
            rememberMe: false,
            error: false,
            loading: false,
            showDialog: false
        }
    },
    validations() {
        return {
            email: {
                required,
                email
            },
            password: {
                required
            }
        }
    },
    methods: {
        async login () {
            this.loading = true;
            const result = await this.v$.$validate()
            if (!result) {
                this.loading = false;
                return;
            }
            await axios.post("/api/login", {
                "email": this.email,
                "password": this.password,
                "remember": this.rememberMe
            }).then(() => {
                this.loading = false;
                this.$router.push("/");
            })
                .catch(() => {
                    this.loading = false;
                    this.error = true;
                })

        }
    }

}
</script>

<style scoped>
.external {
    height: 100vh;
    z-index: -1;
    background-image: url("https://www.truthmedia.gr/sites/default/files/online-shopping-ecommerce-ss-1920_1.png");
}

.eye {
    right: 0;
    margin-right: 8px;
}
</style>
