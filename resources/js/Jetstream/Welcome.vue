<template>
    <div>
        <!-- page title + search bar -->
        <div class="p-6 sm:pl-20 sm:pr-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>
            <div class="mt-8 text-2xl">
                Products List
            </div>

            <!-- TODO retrieve from database -->
            <div class="flex mt-6 align-middle items-center">
                <div class="flex-1">
                    <p>Showing 9 out of 100 products</p>
                </div>
                <div class="flex-none">
                    <div class="pt-2 relative mx-auto text-gray-600">
                        <input v-model="search" class="border-2 border-gray-300 bg-white h-10 px-5 pr-5 mr-2 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Search products">
                        <button type="submit" class="relative right-0 top-0 mt-5 mr-4">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                 viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 'filtered' product list -->
        <div id="productList" class="grid grid-cols-1 md:grid-cols-3 w-full bg-gray-200 bg-opacity-25" style="width: 100%">
            <div v-for="product in filteredProductList">
                <product-post>
                    <template v-slot:productName>
                        {{ product.name }}
                    </template>
                    <template v-slot:productDescription>
                        {{ product.description }}
                    </template>
                    <template v-slot:productDiscount>
                        {{ product.discount }}
                    </template>
                    <template v-slot:productAvailableStock>
                        {{ product.availableStock }}
                    </template>
                </product-post>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import Button from "@/Jetstream/Button";
    import ProductPost from "@/Pages/ProductPost";

    export default {
        components: {
            ProductPost,
            Button,
            JetApplicationLogo,
        },

        data() {
            return {
                search: '',
                //test data
                productsList: [
                    { id:1, name:'Balloon', description:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        discount:'25% off', availableStock:'3' },
                    { id:2, name:'Riser', description:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ',
                        discount:'25% off', availableStock:'10' },
                    { id:3, name:'Comb', description:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        discount:'10% off', availableStock:'1' },
                    { id:4, name:'Blower', description:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        discount:'0% off', availableStock:'0' },
                    { id:5, name:'Orange', description:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        discount:'50% off', availableStock:'6' },
                ],
            }
        },

        computed: {
            filteredProductList() {
                return this.productsList.filter(product => {
                    return product.name.toLowerCase().includes(this.search.toLowerCase())
                });
            }
        },
    }
</script>
