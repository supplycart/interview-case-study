<template>
    <div class="bg-white">
        <TransitionRoot as="template" :show="mobileFiltersOpen">
            <Dialog as="div" class="fixed inset-0 flex z-40 lg:hidden" @close="mobileFiltersOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="translate-x-full">
                    <div class="ml-auto relative max-w-xs w-full h-full bg-white shadow-xl py-4 pb-12 flex flex-col overflow-y-auto">
                        <div class="px-4 flex items-center justify-between">
                            <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                            <button type="button" class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400" @click="mobileFiltersOpen = false">
                                <span class="sr-only">Close menu</span>
                                <XIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>

                        <form class="mt-4 border-t border-gray-200">
                            <Disclosure as="div" v-for="section in filters" :key="section.id" class="border-t border-gray-200 px-4 py-6" v-slot="{ open }">
                                <h3 class="-mx-2 -my-3 flow-root">
                                    <DisclosureButton class="px-2 py-3 bg-white w-full flex items-center justify-between text-gray-400 hover:text-gray-500">
                                        <span class="font-medium text-gray-900">
                                            {{ section.name }}
                                        </span>
                                        <span class="ml-6 flex items-center">
                                            <PlusSmIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                            <MinusSmIcon v-else class="h-5 w-5" aria-hidden="true" />
                                        </span>
                                    </DisclosureButton>
                                </h3>
                                <DisclosurePanel class="pt-6">
                                    <div class="space-y-6">
                                        <div v-for="(option, optionIdx) in section.options" :key="option.value" class="flex items-center">
                                            <input :id="`filter-mobile-${section.id}-${optionIdx}`" :name="`${section.id}[]`" :value="option.value" type="checkbox" :checked="option.checked" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500" />
                                            <label :for="`filter-mobile-${section.id}-${optionIdx}`" class="ml-3 min-w-0 flex-1 text-gray-500">
                                                {{ option.label }}
                                            </label>
                                        </div>
                                    </div>
                                </DisclosurePanel>
                            </Disclosure>
                        </form>
                    </div>
                </TransitionChild>
            </Dialog>
        </TransitionRoot>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 flex items-baseline justify-between pt-24 pb-6 border-b border-gray-200">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Products</h1>

                <div class="flex items-center">
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">Sort
                                <ChevronDownIcon class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <MenuItem v-for="option in sortOptions" :key="option.name" v-slot="{ active }">
                                        <a :href="option.href" :class="[option.current ? 'font-medium text-gray-900' : 'text-gray-500', active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']">
                                            {{ option.name }}
                                        </a>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>

            <section aria-labelledby="products-heading" class="pt-6 pb-24">
                <h2 id="products-heading" class="sr-only">Products</h2>
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-10">
                    <form class="hidden lg:block">
                        <Disclosure as="div" v-for="section in filters" :key="section.id" class="border-b border-gray-200 py-6" v-slot="{ open }">
                            <h3 class="-my-3 flow-root">
                            <DisclosureButton class="py-3 bg-white w-full flex items-center justify-between text-sm text-gray-400 hover:text-gray-500">
                                <span class="font-medium text-gray-900">
                                    {{ section.name }}
                                </span>
                                <span class="ml-6 flex items-center">
                                    <PlusSmIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                    <MinusSmIcon v-else class="h-5 w-5" aria-hidden="true" />
                                </span>
                            </DisclosureButton>
                            </h3>
                            <DisclosurePanel class="pt-6">
                                <div class="space-y-4">
                                    <div v-for="(option, optionIdx) in section.options" :key="option.value" class="flex items-center">
                                        <input @change="getInputValue(section.id)" :id="`filter-${section.id}-${optionIdx}`" :name="`${section.id}[]`" :value="option.value" type="checkbox" :checked="option.checked" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500" />
                                        <label :for="`filter-${section.id}-${optionIdx}`" class="ml-3 text-sm text-gray-600">
                                            {{ option.label }}
                                        </label>
                                    </div>
                                </div>
                            </DisclosurePanel>
                        </Disclosure>
                    </form>

                    <div class="lg:col-span-3">
                        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 lg:h-full">
                            <div class="bg-white">
                                <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                                    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                                        <div v-for="product in products" :key="product.id" class="group relative">
                                            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                                <img :src="product.imageSrc" :alt="product.imageAlt" class="w-full h-full object-center object-cover lg:w-full lg:h-full" />
                                            </div>
                                            <div class="mt-4 flex justify-between">
                                                <div>
                                                    <h3 class="text-sm text-gray-700">
                                                        <div @click="openProduct(product.id)">
                                                            <span aria-hidden="true" class="absolute inset-0" />
                                                            {{ product.name }}
                                                        </div>
                                                    </h3>
                                                </div>
                                                <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
            <div class="flex min-h-screen text-center md:block md:px-2 lg:px-4" style="font-size: 0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity md:block" />
                </TransitionChild>

                <span class="hidden md:inline-block md:align-middle md:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95" enter-to="opacity-100 translate-y-0 md:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 md:scale-100" leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95">
                    <div class="flex text-base text-left transform transition w-full md:inline-block md:max-w-2xl md:px-4 md:my-8 md:align-middle lg:max-w-4xl">
                        <div class="w-full relative flex items-center bg-white px-4 pt-14 pb-8 overflow-hidden shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                            <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8" @click="open = false">
                                <span class="sr-only">Close</span>
                                <XIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <div class="w-full grid grid-cols-1 gap-y-8 gap-x-6 items-start sm:grid-cols-12 lg:gap-x-8">
                                <div class="aspect-w-2 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden sm:col-span-4 lg:col-span-5">
                                    <img :src="product.imageSrc" :alt="product.imageAlt" class="object-center object-cover" />
                                </div>
                                <div class="sm:col-span-8 lg:col-span-7">
                                    <h2 class="text-2xl font-extrabold text-gray-900 sm:pr-12">
                                        {{ product.name }}
                                    </h2>

                                    <section aria-labelledby="information-heading" class="mt-2">
                                        <h3 id="information-heading" class="sr-only">Product information</h3>

                                        <p class="text-2xl text-gray-900">
                                            {{ product.price }}
                                        </p>

                                        <div class="mt-6">
                                            <h4 class="sr-only">Reviews</h4>
                                            <div class="flex items-center">
                                                <div class="flex items-center">
                                                    <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[product.rating > rating ? 'text-gray-900' : 'text-gray-200', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                                                </div>
                                                <p class="sr-only">{{ product.rating }} out of 5 stars</p>
                                                <p class="ml-3 text-sm font-medium text-gray-600">{{ product.reviewCount }} reviews</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section aria-labelledby="options-heading" class="mt-10">
                                        <h3 id="options-heading" class="sr-only">Product options</h3>

                                        <form @submit.prevent="submitForm()">
                                            <div>
                                                <h4 class="text-sm text-gray-900 font-medium">Color</h4>
                                                <RadioGroup v-model="selectedColor" class="mt-4">
                                                    <RadioGroupLabel class="sr-only"> Choose a color </RadioGroupLabel>
                                                    <div class="flex items-center space-x-3">
                                                        <RadioGroupOption as="template" v-for="color in product.colors" :key="color.name" :value="color" v-slot="{ active, checked }">
                                                        <div :class="[color.selectedClass, active && checked ? 'ring ring-offset-1' : '', !active && checked ? 'ring-2' : '', '-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none']">
                                                            <RadioGroupLabel as="p" class="sr-only">
                                                            {{ color.name }}
                                                            </RadioGroupLabel>
                                                            <span aria-hidden="true" :class="[color.class, 'h-8 w-8 border border-black border-opacity-10 rounded-full']" />
                                                        </div>
                                                        </RadioGroupOption>
                                                    </div>
                                                </RadioGroup>
                                            </div>

                                            <div class="mt-10">
                                                <div class="flex items-center justify-between">
                                                    <h4 class="text-sm text-gray-900 font-medium">Size</h4>
                                                </div>

                                                <RadioGroup v-model="selectedSize" class="mt-4">
                                                    <RadioGroupLabel class="sr-only"> Choose a size </RadioGroupLabel>
                                                    <div class="grid grid-cols-4 gap-4">
                                                        <RadioGroupOption as="template" v-for="size in product.sizes" :key="size.name" :value="size" :disabled="!size.inStock" v-slot="{ active, checked }">
                                                        <div :class="[size.inStock ? 'bg-white shadow-sm text-gray-900 cursor-pointer' : 'bg-gray-50 text-gray-200 cursor-not-allowed', active ? 'ring-2 ring-indigo-500' : '', 'group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1']">
                                                            <RadioGroupLabel as="p">
                                                            {{ size.name }}
                                                            </RadioGroupLabel>
                                                            <div v-if="size.inStock" :class="[active ? 'border' : 'border-2', checked ? 'border-indigo-500' : 'border-transparent', 'absolute -inset-px rounded-md pointer-events-none']" aria-hidden="true" />
                                                            <div v-else aria-hidden="true" class="absolute -inset-px rounded-md border-2 border-gray-200 pointer-events-none">
                                                                <svg class="absolute inset-0 w-full h-full text-gray-200 stroke-2" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                                                                    <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        </RadioGroupOption>
                                                    </div>
                                                    </RadioGroup>
                                            </div>
                                            <button type="submit" class="mt-6 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add to cart</button>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>

    <TransitionRoot as="template" :show="add">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="add = false">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <CheckCircleIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900"> Thank You.</DialogTitle>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Item have been add to cart.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="add = false" ref="cancelButtonRef">Closed</button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
    import { ref } from 'vue'
    import {
        Dialog,
        DialogTitle,
        DialogOverlay,
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
    } from '@headlessui/vue'
    import { XIcon } from '@heroicons/vue/outline'
    import { StarIcon, ChevronDownIcon, FilterIcon, MinusSmIcon, PlusSmIcon, ShoppingCartIcon, CheckCircleIcon } from '@heroicons/vue/solid'

    export default {
        components: {
            Dialog,
            DialogTitle,
            DialogOverlay,
            RadioGroup,
            RadioGroupLabel,
            RadioGroupOption,
            Disclosure,
            DisclosureButton,
            DisclosurePanel,
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            TransitionChild,
            TransitionRoot,
            ChevronDownIcon,
            FilterIcon,
            MinusSmIcon,
            PlusSmIcon,
            ShoppingCartIcon,
            CheckCircleIcon,
            StarIcon,
            XIcon,
        },
        data() {
            return {
                sortOptions: Array,
                filters: Array,
                mobileFiltersOpen: Boolean(false),
                products: Array,
                product: Object,
                open: Boolean(false),
                add: Boolean(false),
                selectedColor: Object,
                selectedSize: Object,
                flag: Boolean(false),
                countCart: String
            }
        },
        props: {
            submitRoute: String,
            sortRoute: String,
            productData: Array,
        },
        mounted() {
            this.sortOptions = [
                { name: 'Most Popular', href: this.sortRoute+'/reviewCount/desc', current: false },
                { name: 'Best Rating', href: this.sortRoute+'/rating/desc', current: false },
                { name: 'Newest', href: this.sortRoute+'/created_at/desc', current: false },
                { name: 'Price: Low to High', href: this.sortRoute+'/price/asc', current: false },
                { name: 'Price: High to Low', href: this.sortRoute+'/price/desc', current: false },
            ]
            this.filters = [
                {
                    id: 'color',
                    name: 'Color',
                    options: [
                        { value: 'Black', label: 'Black', checked: false },
                        { value: 'White', label: 'White', checked: false },
                        { value: 'Gray', label: 'Gray', checked: false },
                        { value: 'Peach', label: 'Peach', checked: false },
                    ],
                },
                {
                    id: 'size',
                    name: 'Size',
                    options: [
                        { value: 'S', label: 'S', checked: false },
                        { value: 'M', label: 'M', checked: false },
                        { value: 'L', label: 'L', checked: false },
                        { value: 'XL', label: 'XL', checked: false },
                    ],
                },
            ]

            this.products = this.productData
        },
        methods: {  
            openProduct(id) {
                this.products.forEach((item)=>{
                    if(item.id == id){
                        this.flag = true;
                        this.product = ref(item);                       
                        this.mobileFiltersOpen = ref(false)
                        this.open = ref(true)
                        item.colors = ref(JSON.parse(item.colors))
                        item.sizes = ref(JSON.parse(item.sizes))
                        this.selectedColor = ref(item.colors[0])
                        item.sizes.forEach((size,key)=>{
                            if(size.inStock && this.flag){
                                this.selectedSize = ref(item.sizes[key]);
                                this.flag = false;
                            }
                        })
                    }
                })
            },
            submitForm() {
                this.product.color = this.selectedColor.name;
                this.product.size = this.selectedSize.name;
                this.open = ref(false);
                axios.post(this.submitRoute,this.product).then(response => {
                    if(response){
                        this.add = ref(true)
                        location.reload()
                    }
                }).catch(error => console.log(error));
            },
            getInputValue(field) {
                this.products = this.productData
                const checkedList = [];
                const node = document.querySelectorAll('input[type=checkbox]');
                
                for (const checkbox of node) {
                    if (checkbox.checked){
                        checkedList.push(checkbox.value);
                    }
                }

                if(checkedList.length > 0){
                    const valueList = [];
                    this.productData.forEach((value)=>{
                        if(field == 'color'){
                            const temp = JSON.parse(value.colors)
                            for(const item of checkedList){
                                if(item == temp[0].name){
                                    valueList.push(value)
                                }
                            }
                        }else if(field == 'size'){
                            const temp = JSON.parse(value.sizes)
                            for(const size of temp){
                                for(const item of checkedList){
                                    if(item == size.name && size.inStock){
                                        valueList.push(value)
                                    }
                                }
                            }
                        }
                    })
                    this.products = valueList;
                }else{
                    this.products = this.productData
                }
            },
        },
    }
</script>