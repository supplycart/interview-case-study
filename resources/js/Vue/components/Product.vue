<template>
    <div class="rounded overflow-hidden shadow-lg m-1 flex flex-col card cursor-pointer" @click="select">
        <img class="product-img" :src="product.picture" :alt="product.name">
        <div class="px-4 py-2 flex flex-col grow">
            <h4 class="font-bold text-md">{{product.category.name}}</h4>
            <h3 class="font-bold text-xl mb-2">{{product.name.slice(0, -1)}}</h3>
            <p class="text-gray-700 text-sm">
                {{product.description}}
            </p>
            <spacer/>
            <p class="font-bold mt-2 text-md text-blue-600">RM {{product.price}}</p>
        </div>
    </div>
</template>

<script>
import Spacer from "./Spacer";
export default {
    name: "Product",
    components: {Spacer},
    props: ["product"],
    methods: {
        select() {
            this.$emit("selected");
        }
    }
}
</script>

<style scoped lang="scss">
.product-img {
    @apply w-full object-cover object-center;
    aspect-ratio: 1;
}

.card {
    @apply hover:border-cyan-600 hover:border-2;
    transition: 100ms all ease-in;
    &:hover {
        transform: scale3d(1.03, 1.03, 1);
        z-index: 4;
    }
}
</style>
