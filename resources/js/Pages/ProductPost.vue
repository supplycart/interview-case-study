<template>
    <div>
        <div class="bg-grey-light py-8 w-full flex justify-center items-center">
            <div class="bg-white rounded mx-8 shadow hover:shadow-md duration-4">
                <div class="flex flex-row justify-between w-full uppercase font-bold text-blue-dark border-b p-6">
                    <slot name="productName"></slot>
                    <div class="cursor-pointer text-grey-dark hover:text-blue duration-4"><i class="fas fa-ellipsis-v"></i></div>
                </div>

                <div class="p-6 text-grey-darker text-justify flex flex-col">
                    <img src="https://picsum.photos/300/300" alt="Some image" class="w-64 flex self-center rounded-full shadow-lg mb-6">
                    <p class="font-bold text-sm uppercase mb-2 text-blue-darker">Item description:<p>
                        <span class="text-grey-darker">
                            <slot name="productDescription"></slot>
                        </span>
                    <div class="pt-4">
                        <span class="uppercase bg-green-500 text-white font-bold p-2 text-xs shadow rounded">
                            <slot name="productDiscount"></slot>
                        </span>
                        <span class="ml-4 uppercase bg-yellow-400 text-gray-900 font-bold p-2 text-xs shadow rounded">
                            Stock left: <slot name="productAvailableStock"></slot>
                        </span>
                    </div>
                </div>
                <div class="p-6 text-grey-darker text-justify flex flex-row justify-end border-t">
                    <button class="uppercase self-end text-blue-400 mx-8 text-sm hover:text-blue-800 duration-4 self-center">Details</button>
                    <button class="uppercase self-end bg-green-400 font-bold text-white px-6 py-4 rounded hover:bg-green-800 duration-4"><i class="fa fa-cart-plus mr-4"></i>Add to cart</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductPost"
    }
</script>

<style scoped>
    .duration-4 {
        transition-duration: 0.4s;
    }
</style>
