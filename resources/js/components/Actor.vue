<template>
    <div class="bg-white">
        <TransitionRoot as="template" :show="mobileFiltersOpen">
            <Dialog as="div" class="fixed inset-0 flex z-40 lg:hidden" @close="mobileFiltersOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>
            </Dialog>
        </TransitionRoot>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 flex items-baseline justify-between pt-24 pb-6 border-b border-gray-200">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Actors List</h1>
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" @click="showForm = !showForm">
                    <PlusIcon class="h-5 w-5" aria-hidden="true" />
                     Add Actor
                </button>
            </div>

            <div v-if="showForm" class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="submitActor()">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700 required">Actor name</label>
                                        <input type="text" v-model="form.name" name="name" id="name" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                        <input type="date" v-model="form.date_of_birth" name="date_of_birth" id="date_of_birth" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="biography" class="block text-sm font-medium text-gray-700">Biography</label>
                                        <textarea name="biography" v-model="form.biography" rows="5" id="biography" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                                        <select id="sex" name="sex" v-model="form.sex" autocomplete="off" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label class="block text-sm font-medium text-gray-700"> Profile Image </label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload image</span>
                                                    <input id="image" name="image" type="file" @change="selectFileAdd" class="sr-only">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right space-x-4 sm:px-6">
                                <button @click="showForm = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <span>Cancel</span>
                                </button>
                                <button type="submit" class="bg-black text-white hover:bg-white hover:text-black font-bold py-2 px-4 rounded inline-flex items-center">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <section aria-labelledby="actors-heading" class="pt-6 pb-24">
                <h2 id="actors-heading" class="sr-only">Actors List</h2>
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-12">
                    <div class="lg:col-span-4">
                        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 lg:h-full">
                            <div class="bg-white">
                                <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                                    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                                        <div v-for="actor in actors" :key="actor.id" class="group relative">
                                            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                                <img :src="actor.imagePath" class="w-full h-full object-center object-cover lg:w-full lg:h-full" />
                                            </div>
                                            <div class="mt-4 flex justify-between">
                                                <div>
                                                    <h3 class="text-sm text-gray-700">
                                                        <div @click="openActor(actor.id)">
                                                            <span aria-hidden="true" class="absolute inset-0" />
                                                            <h3 class="text-lg leading-6 font-bold text-gray-900">{{ actor.name }}</h3>
                                                        </div>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="mt-4 flex justify-between">
                                                <p class="text-sm font-medium text-justify text-gray-900">{{ actor.sex }} - {{ actor.dateFormat }}</p>
                                            </div>
                                            <div class="mt-4 flex justify-between">
                                                <p class="text-sm font-medium text-justify text-gray-900">{{ actor.biography }}</p>
                                            </div>
                                            <div v-if="actor.movie" class="mt-4 flex">
                                                <p class="text-sm font-bold italic text-gray-900">Featuring:</p>
                                            </div>
                                            <div v-if="actor.movie">
                                                <p class="text-sm font-medium italic text-gray-900">{{ actor.movie.name }}</p>
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
                                    <img :src="actor.imagePath"  class="object-center object-cover" />
                                </div>
                                <div class="sm:col-span-8 lg:col-span-7">
                                    <h2 class="text-2xl font-extrabold text-gray-900 sm:pr-12">
                                        {{ actor.name }}
                                    </h2>

                                    <section aria-labelledby="information-heading" class="mt-2">
                                        <h3 id="information-heading" class="sr-only">Actor Details</h3>

                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <form @submit.prevent="updateActor(actor.id)">
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="name" class="block text-sm font-medium text-gray-700 required">Actor name</label>
                                                        <input id="name" type="text" v-model="actor.name" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                                        <input id="date_of_birth" type="date" v-model="actor.date_of_birth" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label for="biography" class="block text-sm font-medium text-gray-700">Biography</label>
                                                        <textarea id="biography" rows="5" v-model="actor.biography" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                                                        <select id="sex" name="sex" v-model="actor.sex" autocomplete="off" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label class="block text-sm font-medium text-gray-700"> Profile Image </label>
                                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                            <div class="space-y-1 text-center">
                                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            <div class="flex text-sm text-gray-600">
                                                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                    <span>Upload image</span>
                                                                    <input id="image" name="image" type="file" @change="selectFileUpdate" class="sr-only">
                                                                </label>
                                                                <p class="pl-1">or drag and drop</p>
                                                            </div>
                                                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-6 text-right space-x-4">
                                                        <button @click="deleteActor(actor.id)" class="mt-6 w-1/3 items-center justify-center text-base font-medium bg-red-600 text-white hover:bg-white hover:text-red-600 font-bold py-2 px-4 rounded inline-flex items-center">Delete</button>
                                                        <button type="submit" class="mt-6 w-1/3 items-center justify-center text-base font-medium bg-black text-white hover:bg-white hover:text-black font-bold py-2 px-4 rounded inline-flex items-center">Edit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                            </div>
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
    import { StarIcon, ChevronDownIcon, FilterIcon, MinusSmIcon, PlusSmIcon, ShoppingCartIcon, CheckCircleIcon, PlusIcon } from '@heroicons/vue/solid'
    
    const initialState = () => {
        return {
            name: '',
            date_of_birth: '',
            biography: '',
            sex: '',
            image: '',
        };
    };

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
            PlusIcon,
        },
        data() {
            return {
                mobileFiltersOpen: '',
                actors: [],
                actor: {},
                open: false,
                showForm: false,
                form: initialState(),
            }
        },
        props: {
            submitRoute: String,
            actorData: Array,
        },
        mounted() {
            this.actors = this.actorData;
        },
        methods: {  
            openActor(id) {
                this.actors.forEach((value)=>{
                    if(value.id == id){
                        this.open = true;
                        this.actor = value;
                        this.mobileFiltersOpen = false;
                    }
                })
            },
            deleteActor(id) {
                axios.delete('actor/'+ id).then(response => {
                    if (response.data.status == 'success') {
                        this.open = false
                        this.$toast.success(response.data.message)
                        this.actors = response.data.data
                        this.reset()
                    } else {
                        this.$toast.error(response.data.message)
                    }
                }).catch(error => {
                    this.$toast.error(error.data.message)
                });
            },
            updateActor(id) {
                const editData = new FormData()
                editData.append('name', this.actor.name)
                editData.append('date_of_birth', this.actor.date_of_birth)
                editData.append('biography', this.actor.biography)
                editData.append('sex', this.actor.sex)
                editData.append('image', this.actor.image ?? '')
                editData.append('imageNew', this.actor.imageNew ?? '')
                editData.append('_method', 'patch')
                axios.post('actor/'+ id, editData).then(response => {
                    if (response.data.status == 'success') {
                        this.open = false
                        this.$toast.success(response.data.message)
                        this.actors = response.data.data
                        this.reset()
                    } else {
                        this.$toast.error(response.data.message)
                    }
                }).catch(error => {
                    this.$toast.error(error.data.message)
                });
            },
            submitActor() {
                const formData = new FormData()
                formData.append('name', this.form.name)
                formData.append('date_of_birth', this.form.date_of_birth)
                formData.append('biography', this.form.biography)
                formData.append('sex', this.form.sex)
                formData.append('image', this.form.image)
                axios.post(this.submitRoute, formData).then(response => {
                    if (response.data.status == 'success') {
                        this.showForm = false
                        this.$toast.success(response.data.message)
                        this.actors = response.data.data
                        this.reset()
                    } else {
                        this.$toast.error(response.data.message)
                    }
                }).catch(error => {
                    this.$toast.error(error.data.message)
                });
            },
            reset() {
                Object.assign(this.form, initialState());
            },
            selectFileAdd(event) {
                this.form.image = event.target.files[0];
            },
            selectFileUpdate(event) {
                this.actor.imageNew = event.target.files[0];
            }
        },
    }
</script>