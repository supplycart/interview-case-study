<template>
    <div
        class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500"
    >
        <span class="text-xl inline-block align-middle">
            <svg
                class="fill-current h-6 w-6 text-teal-500 mr-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
            >
                <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                />
            </svg>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{ data.notification }}</b>
            {{ data.description }}
        </span>
        <button
            class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none"
            @click="closeNotification"
        >
            <span>×</span>
        </button>
    </div>
</template>
<script>
export default {
    props: ["message"],
    data() {
        return {};
    },
    computed: {
        data: function() {
            if (this.message != null) {
                return this.message;
            }
            return {
                notification: "",
                description: ""
            };
        }
    },
    methods: {
        goToCart(event) {
            this.$router.push("/cart");
        },
        closeNotification(event) {
            this.$emit("close", this.message);
        }
    }
};
</script>
