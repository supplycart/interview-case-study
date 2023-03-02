<template>
    <div class="rounded-lg border border-slate-200 py-2 flex flex-col px-5">
        <img
            :src="product.image"
            alt=""
            class="aspect-square object-contain rounded mb-2"
        />
        <p class="font-bold text-lg">{{ product.name }}</p>
        <p class="grow text-sm">{{ product.description }}</p>
        <p class="text-center mt-4 font-bold text-lg">
            <span v-if="productDiscount > 0">
                RM{{ product.discounted_price }}
                <s class="text-slate-400 text-sm ml-3">
                    RM{{ product.price }}</s
                >
            </span>
            <span v-else> RM{{ product.price }} </span>
        </p>
        <button
            class="bg-lime-200 w-full rounded-full py-1 mt-3 font-medium"
            @click="addToCart(product.id)"
        >
            Add to Cart
        </button>
    </div>
</template>

<script>
export default {
    props: { product: Object, productDiscount: Number },
    methods: {
        addToCart(product_id) {
            this.$emit("addToCart", product_id);
        },
    },
};
</script>
