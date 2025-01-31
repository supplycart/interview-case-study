<template>
    <div class="flex justify-center items-center h-screen">
        <div class="w-96 p-6 shadow-lg bg-white rounded">
            <h2 class="text-2xl font-bold mb-5">Login</h2>
            <input
                type="email"
                v-model="email"
                placeholder="Email"
                class="w-full p-2 border rounded mb-2"
            />
            <input
                type="password"
                v-model="password"
                placeholder="Password"
                class="w-full p-2 border rounded mb-2"
            />
            <button
                @click="login"
                class="w-full bg-blue-500 text-white p-2 rounded"
            >
                Login
            </button>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";
export default {
    setup() {
        const email = ref("");
        const password = ref("");
        const router = useRouter();

        const login = async () => {
            const response = await fetch("/api/login", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    email: email.value,
                    password: password.value,
                }),
            });
            if (response.ok) router.push("/home");
        };

        return { email, password, login };
    },
};
</script>
