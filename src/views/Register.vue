<template>
    <div class="container mx-auto">
        <form @submit.prevent="Register">
            <div id="login" class="bg-white shadow-md p-12 inline-block rounded-lg">
            <h2 class="text-xl text-center pb-3">Register</h2>
            <div class="mb-6">
                <div><label>Email</label></div>
                <input class="border-b-2" type="text" name="registerUser" placeholder="Email" v-model="email" required>
            </div>
            <div class="mb-6">
                <div><label>New Password</label></div>
                <input class="border-b-2" type="password" name="registerPass" v-model="password" placeholder="Password" required>
            </div>
            <div class="text-center">
                <button class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Login</button>
            </div>
            </div>
        </form>
    </div>
</template>

<script>
import firebase from 'firebase'
import { ref } from 'vue'

export default {
    setup() {
        const email = ref('')
        const password = ref('')

        const Register = () => {
            firebase.auth().createUserWithEmailAndPassword(email.value, password.value).then((user) => {
                alert('Registered!')
            }).catch((err) => {
                alert(err.message)
            })
        }

        return { Register, email, password }
    }
}
</script>

<style>

</style>