<template>
    <div class="container mx-auto">
        <form @submit.prevent="Login">
            <div id="login" class="bg-white shadow-md p-12 inline-block rounded-lg">
            <h2 class="text-xl text-center pb-3">Login</h2>
            <div class="mb-6">
                <div>Username</div>
                <input class="border-b-2" type="text" placeholder="Username" v-model="email">
            </div>
            <div class="mb-6">
                <div>Password</div>
                <input class="border-b-2" type="password" name="loginPass" v-model="password" placeholder="Password">
            </div>
            <div class="text-center mb-4">
                <button class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Login</button>
            </div>
            <div>
                <router-link :to="{ name: 'Register' }">New user? Click here to register</router-link>
            </div>
            </div>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue'
import firebase from 'firebase'

export default {
    setup() {
        const email = ref("")
        const password = ref("")

        const Login = () => {
            firebase.auth().signInWithEmailAndPassword(email.value, password.value).catch((err) => {
                alert(err.message)
            })
        }

        return { Login, email, password }
    }
}
</script>

<style>

</style>