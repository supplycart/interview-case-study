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
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Movies List</h1>
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" @click="showForm = !showForm">
                    <PlusIcon class="h-5 w-5" aria-hidden="true" />
                     Add Movie
                </button>
            </div>

            <div v-if="showForm" class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="submitMovie()">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700 required">Movie name</label>
                                        <input type="text" v-model="form.name" name="name" id="name" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="year_of_release" class="block text-sm font-medium text-gray-700 required">Year of Release</label>
                                        <input type="text" v-model="form.year_of_release" @keypress="isNumber($event)" name="year_of_release" id="year_of_release" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="plot" class="block text-sm font-medium text-gray-700 required">Plot</label>
                                        <textarea name="plot" v-model="form.plot" rows="5" id="plot" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="actor" class="block text-sm font-medium text-gray-700">Actor</label>
                                        <input type="text" v-model="form.actor" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" list="actor">
                                        <datalist id="actor">
                                            <option v-for="actorVal in getActor" :key="actorVal.id">{{ actorVal.name }}</option>
                                        </datalist>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="producer" class="block text-sm font-medium text-gray-700">Producer</label>
                                        <input type="text" v-model="form.producer" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" list="producer">
                                        <datalist id="producer">
                                            <option v-for="producerVal in getProducer" :key="producerVal.id">{{ producerVal.name }}</option>
                                        </datalist>
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label class="block text-sm font-medium text-gray-700"> Movie Image </label>
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

            <section aria-labelledby="movies-heading" class="pt-6 pb-24">
                <h2 id="movies-heading" class="sr-only">Movie List</h2>
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-12">
                    <div class="lg:col-span-4">
                        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 lg:h-full">
                            <div class="bg-white">
                                <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                                    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                                        <div v-for="movie in movies" :key="movie.id" class="group relative">
                                            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                                <img :src="movie.imagePath" class="w-full h-full object-center object-cover lg:w-full lg:h-full" />
                                            </div>
                                            <div class="mt-4 flex justify-between">
                                                <div>
                                                    <h3 class="text-sm text-gray-700">
                                                        <div @click="openMovie(movie.id)">
                                                            <span aria-hidden="true" class="absolute inset-0" />
                                                            <h3 class="text-lg leading-6 font-bold text-gray-900">{{ movie.name }} ({{ movie.year_of_release }})</h3>
                                                        </div>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="mt-4 flex justify-between">
                                                <p class="text-sm font-medium text-justify text-gray-900">{{ movie.plot }}</p>
                                            </div>
                                            <div v-if="movie.actors.length > 0" class="mt-4 flex">
                                                <p class="text-sm font-bold italic text-gray-900">Actors:</p>
                                            </div>
                                            <div v-for="actor in movie.actors" :key="actor.id">
                                                <p class="text-sm font-medium italic text-gray-900">{{ actor.name }}</p>
                                            </div>
                                            <div v-if="movie.producer" class="mt-4 flex">
                                                <p class="text-sm font-bold italic text-gray-900">Producer:</p>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium italic text-gray-900">{{ movie.producer?.name }}</p>
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
                                    <img :src="movie.imagePath"  class="object-center object-cover" />
                                </div>
                                <div class="sm:col-span-8 lg:col-span-7">
                                    <h2 class="text-2xl font-extrabold text-gray-900 sm:pr-12">
                                        {{ movie.name }} ({{ movie.year_of_release }})
                                    </h2>

                                    <section aria-labelledby="information-heading" class="mt-2">
                                        <h3 id="information-heading" class="sr-only">Movie Details</h3>

                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <form @submit.prevent="updateMovie(movie.id)">
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="name" class="block text-sm font-medium text-gray-700 required">Movie name</label>
                                                        <input id="name" type="text" v-model="movie.name" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="year_of_release" class="block text-sm font-medium text-gray-700 required">Year of Release</label>
                                                        <input id="year_of_release" type="text" v-model="movie.year_of_release" @keypress="isNumber($event)" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label for="plot" class="block text-sm font-medium text-gray-700 required">Plot</label>
                                                        <textarea id="plot" rows="5" v-model="movie.plot" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="actor" class="block text-sm font-medium text-gray-700">Actor</label>
                                                        <input type="text" v-model="movie.actor" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" list="actor">
                                                        <datalist id="actor">
                                                            <option v-for="actorVal in getActor" :key="actorVal.id">{{ actorVal.name }}</option>
                                                        </datalist>
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="producer" class="block text-sm font-medium text-gray-700">Producer</label>
                                                        <input type="text" v-model="movie.producer.name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" list="producer">
                                                        <datalist id="producer">
                                                            <option v-for="producerVal in getProducer" :key="producerVal.id">{{ producerVal.name }}</option>
                                                        </datalist>
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label class="block text-sm font-medium text-gray-700"> Movie Image </label>
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
                                                        <button @click="deleteMovie(movie.id)" class="mt-6 w-1/3 items-center justify-center text-base font-medium bg-red-600 text-white hover:bg-white hover:text-red-600 font-bold py-2 px-4 rounded inline-flex items-center">Delete</button>
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
            year_of_release: '',
            plot: '',
            actor: '',
            producer: '',
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
                movies: [],
                movie: {},
                open: false,
                showForm: false,
                form: initialState(),
                value: [],
                options: [
                    { name: 'Vue.js', language: 'JavaScript' },
                    { name: 'Adonis', language: 'JavaScript' },
                    { name: 'Rails', language: 'Ruby' },
                    { name: 'Sinatra', language: 'Ruby' },
                    { name: 'Laravel', language: 'PHP' },
                    { name: 'Phoenix', language: 'Elixir' }
                ]
            }
        },
        props: {
            submitRoute: String,
            movieData: Array,
            actorData: Array,
            producerData: Array,
        },
        computed: {
            getActor(){
                return this.actorData;
            },
            getProducer(){
                return this.producerData;
            }
        },
        mounted() {
            this.movies = this.movieData;
        },
        methods: {  
            openMovie(id) {
                this.movies.forEach((value)=>{
                    if(value.id == id){
                        this.open = true;
                        this.movie = value;
                        this.mobileFiltersOpen = false;
                    }
                })
            },
            deleteMovie(id) {
                axios.delete('movie/'+ id).then(response => {
                    if (response.data.status == 'success') {
                        this.open = false
                        this.$toast.success(response.data.message)
                        this.movies = response.data.data
                    }
                }).catch(error => {
                    this.$toast.error(error.data.message)
                });
            },
            updateMovie(id) {
                const editData = new FormData()
                editData.append('name', this.movie.name)
                editData.append('year_of_release', this.movie.year_of_release)
                editData.append('plot', this.movie.plot)
                editData.append('actor', this.movie.actor)
                editData.append('producer', this.movie.producer.name)
                editData.append('image', this.movie.image ?? '')
                editData.append('imageNew', this.movie.imageNew ?? '')
                editData.append('_method', 'patch')
                axios.post('movie/'+ id, editData).then(response => {
                    if (response.data.status == 'success') {
                        this.open = false
                        this.$toast.success(response.data.message)
                        this.movies = response.data.data
                        this.reset()
                    } else {
                        this.$toast.error(response.data.message)
                    }
                }).catch(error => {
                    this.$toast.error(error.data.message)
                });
            },
            submitMovie() {
                const formData = new FormData()
                formData.append('name', this.form.name)
                formData.append('year_of_release', this.form.year_of_release)
                formData.append('plot', this.form.plot)
                formData.append('actor', this.form.actor)
                formData.append('producer', this.form.producer)
                formData.append('image', this.form.image)
                axios.post(this.submitRoute, formData).then(response => {
                    if (response.data.status == 'success') {
                        this.showForm = false
                        this.$toast.success(response.data.message)
                        this.movies = response.data.data
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
            isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ( charCode > 47 && charCode < 58 ) {
                    if(this.form.year_of_release.length < 4 )  
                        return true;
                    else
                        evt.preventDefault();
                } else {
                    evt.preventDefault();
                }
            },
            selectFileAdd(event) {
                this.form.image = event.target.files[0];
            },
            selectFileUpdate(event) {
                this.movie.imageNew = event.target.files[0];
            }
        },
    }
</script>