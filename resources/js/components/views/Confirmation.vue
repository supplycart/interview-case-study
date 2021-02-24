<template>
    <div>
        <div
            class="flex items-center justify-center text-white-400 p-5"
        >
            <h2>
                <div class="m-8">
                    <span
                        class="text-2xl uppercase text-gray-900 font-bold text-center"
                        ><strong>Thank You!</strong></span
                    ><br />
                    <span class="text-md">Your order has been placed.</span>
                </div>
                <router-link
                    :to="{ name: 'userboard' }"
                    class="bg-blue-500 text-center hover:bg-blue-700 text-white font-bold py-2 px-4 m-12 rounded-full"
                >
                    See your orders
                </router-link>
            </h2>
        </div>
    </div>
</template>

<script>
export default {};
</script>

