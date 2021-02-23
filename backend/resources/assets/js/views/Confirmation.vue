<template>
    <div>
        <div
            class="container align-content-center justify-content-center flex-wrap ml-auto"
        >
            <h2>
                <span class="text-3xl"><strong>Thank You!</strong></span
                ><br />
                <span>Your order has been placed.</span
                ><br />
                <router-link :to="{ name: 'userboard' }" class="underline">
                    See your orders
                </router-link>
            </h2>
        </div>
    </div>
</template>

<script>
export default {};
</script>
