<template>
    <div class="fixed top-0 right-0 m-6">
        <div
            v-if="message"
            :class="{
        'bg-red-200 text-red-900': message.type === 'error',
        'bg-green-200 text-green-900': message.type === 'success',
      }"
            class="rounded-lg shadow-md p-6 pr-10"
            style="min-width: 240px"
        >
            <button
                class="opacity-75 cursor-pointer absolute top-0 right-0 py-2 px-3 hover:opacity-100"
            >
                ×
            </button>
            <div class="flex items-center">
                {{ message.text }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: null,
        };
    },
    mounted() {
        Bus.$on('flash-message', (message) => {
            this.message = message;

            setTimeout(() => {
                this.message = null;
            }, 1000);
        });
    }
};
</script>
