<template>
    <div class="grid grid-cols-3 bg-white external">
        <div class="col-span-1">
            <div class="bg-white w-full rounded shadow h-full">
                <div class="mb-10 pt-2 pl-2">
                    <router-link to="/login" class="text-sm hover:text-blue-600">
                        <arrow-left-icon class="h-5 w-5 inline-block"/>
                        Back to Login
                    </router-link>
                </div>
                <div class="w-full space-y-10 px-8">
                    <div>
                        <img class="mx-auto h-12 w-auto" src="/images/logo.webp" alt="Workflow"/>
                        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Register an account</h2>
                    </div>
                    <div class="text-center text-red-500">
                        {{ error ? "Incorrect Email or Password" : "" }}
                    </div>
                    <div class="mt-10 sm:mt-0">
                        <div>
                            <div class="mt-5 md:mt-0">
                                <form class="mt-8 space-y-6">
                                    <input type="hidden" name="remember" value="true"/>
                                    <div class="rounded-md shadow-sm -space-y-px">
                                        <div>
                                            <label for="username" class="sr-only">Username</label>
                                            <input id="username" v-model="username" name="username" type="username"
                                                   autocomplete="username" required=""
                                                   class="form__input appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                                   placeholder="Username"
                                                   :class="v$.username.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'"/>
                                        </div>
                                        <div>
                                            <label for="email-address" class="sr-only">Email address</label>
                                            <input id="email-address" v-model="email" name="email" type="email"
                                                   autocomplete="email" required=""
                                                   class="form__input appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                                   placeholder="Email address"
                                                   :class="v$.email.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'"/>
                                        </div>
                                        <div>
                                            <label for="phone-num" class="sr-only">Email address</label>
                                            <input id="phone-num" v-model="phoneNum" name="phoneNum" type="text"
                                                   autocomplete="phoneNum" required=""
                                                   class="form__input appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                                   placeholder="Phone Number"
                                                   :class="v$.phoneNum.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'"/>
                                        </div>
                                        <div>
                                            <label for="address" class="sr-only">Email address</label>
                                            <textarea id="address" v-model="address" name="address" type="address"
                                                      autocomplete="address" required=""
                                                      class="form__input appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                                      placeholder="Address"
                                                      :class="v$.address.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'"/>
                                        </div>
                                        <div class="relative">
                                            <label for="password" class="sr-only">Password</label>
                                            <input id="password" name="password" v-model="password"
                                                   :type="show ? 'text':'password'" autocomplete="current-password"
                                                   required=""
                                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                                   placeholder="Password"
                                                   :class="v$.password.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'">
                                            <span
                                                class="absolute inset-y-0 right-0 mr-5 text-sm leading-5 flex eye text-blue-600 hover:text-blue-500">
                                            <button type="button" @click="show = !show">
                                                <EyeIcon v-if="!show" class="h-5 w-5" aria-hidden="true"/>
                                                <EyeOffIcon v-else class="h-5 w-5" aria-hidden="true"/>
                                            </button>
                                        </span>
                                        </div>
                                        <div class="relative">
                                            <label for="passwordConfirmation" class="sr-only">Password
                                                Confirmation</label>
                                            <input id="passwordConfirmation" name="passwordConfirmation"
                                                   v-model="passwordConfirmation" :type="show2 ? 'text':'password'"
                                                   autocomplete="current-passwordConfirmation" required=""
                                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                                   placeholder="Password Confirmation"
                                                   :class="v$.passwordConfirmation.$error || error ? 'border-red-500 ring-red-500' : 'border-gray-300'">
                                            <span
                                                class="absolute inset-y-0 right-0 mr-5 text-sm leading-5 flex eye text-blue-600 hover:text-blue-500">
                                            <button type="button" @click="show2 = !show2">
                                                <EyeIcon v-if="!show2" class="h-5 w-5" aria-hidden="true"/>
                                                <EyeOffIcon v-else class="h-5 w-5" aria-hidden="true"/>
                                            </button>
                                        </span>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" @click="register()"
                                                class="group relative button"
                                                :disabled="loading">
                                            <Spinner class="w-5 h-5 fill-blue-400" v-if="loading"/>
                                            <span v-else>Register</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <img src="https://images.theconversation.com/files/351878/original/file-20200810-22-przb4a.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1200&h=900.0&fit=crop"
                alt="background image"
                class="h-full w-full"/>
        </div>
    </div>
    <information-dialog title="Registration Status" :error="error"
                        :description="!error ? 'Registered Successfully! Please proceed to login.' :
                        'Some errors have occurred, please check your input and try again.'"
                        :is-open="showDialog" @close="showDialog = false"/>
</template>

<script>
import {EyeIcon, EyeOffIcon, ArrowLeftIcon} from "@heroicons/vue/solid";
import useVuelidate from "@vuelidate/core";
import {email, required, maxLength, sameAs} from "@vuelidate/validators";
import Spinner from "./components/Spinner";
import InformationDialog from "./components/InformationDialog";

export default {
    name: "Register",
    components: {Spinner, EyeIcon, EyeOffIcon, ArrowLeftIcon, InformationDialog},
    mounted() {
        console.log(window.auth_user);
    },
    setup() {
        return {v$: useVuelidate()}
    },
    data() {
        return {
            email: "",
            password: "",
            passwordConfirmation: "",
            username: "",
            address: "",
            phoneNum: "",

            show: false,
            show2: false,
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
            },
            username: {
                required,
                maxLength: maxLength(128)
            },
            passwordConfirmation: {
                required,
                sameAs: sameAs(this.password)
            },
            phoneNum: {
                required,
                maxLength: maxLength(16)
            },
            address: {
                required,
            }
        }
    },
    methods: {
        async register() {
            this.loading = true;
            const result = await this.v$.$validate()
            if (!result) {
                this.loading = false;
                return;
            }
            await axios.post("/api/user", {
                "email": this.email,
                "password": this.password,
                "username": this.username,
                "phone_num": this.phoneNum,
                "address": this.address
            }).then(() => {
                this.loading = false;
                this.showDialog = true;
                this.error = false;
            })
                .catch(() => {
                    this.loading = false;
                    this.error = true;
                    this.showDialog = true;
                })

        }
    }
}
</script>

<style scoped>
.external {
    height: 100vh;
}
</style>
