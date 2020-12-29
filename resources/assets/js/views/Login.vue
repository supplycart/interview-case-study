<template>
    <layout>
        <div class="w-full">
            <div class="flex justify-center">
                <div class="bg-white shadow-lg w-2/6 m-6 px-6">
                    <div class="text-center text-3xl p-4 border-b-2 border-gray-200 ">Welcome back</div>
                    <form class="p-4" method="POST" @submit.prevent="login">
                        <div class="flex my-3">
                            <label for="email" class="w-1/3">E-Mail Address</label>
                            <div class="w-2/3">
                                <input class="w-full border rounded-md border-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent p-1" id="email" type="email" name="email" v-model="email" placeholder="Your Email" required autofocus>
                            </div>
                        </div>
                        <div class="flex my-3">
                            <label for="password" class="w-1/3">Password</label>
                            <div class="w-2/3">
                                <input class="w-full border rounded-md border-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent p-1" id="password" type="password" name="password" placeholder="Your Password" v-model="password" required>
                            </div>
                        </div>
                        <span class="text-red-600 text-xs" v-if="error">
                            <strong>** {{ error }}</strong>
                        </span>
                        <hr />
                        <button type="submit" class="w-full bg-green-300 rounded-md p-2 mt-5 mb-3">
                            Login
                        </button>
                        <div class="text-xs text-center">Don't have an account ? <button class="text-blue-600 text-sm" @click="$router.push({ path: '/register' })">Sign Up</button></div>
                    </form>
                </div>
            </div>
        </div>
    </layout>
</template>
<script>
    export default {
        data() {
            return {
                error: '',
                email: '',
                password: ''
            }
        },
        methods: {
            async login() {
                this.error = ''

                await this.$store.dispatch('login', {email: this.email, password: this.password})
                let login_fail = this.$store.state.login_fail

                if (login_fail) {
                    this.error = login_fail && 'Invalid email/password'
                } else {
                    router.push({ path: '/products' })
                }
            }
        }
    }
</script>