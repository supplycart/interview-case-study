<template>
    <div class="h-screen bg-white content-center">
        <div class="flex w-full">
            <div class="bg-blue-800 w-48 border-r-2 ">
                <div class="justify-center p-8">
                    <button class="zoom-icon focus:outline-none focus:shadow-outline focus:border-blue-300" v-on:click="toggleModalCart()">
                        <svg id="Layer_1" enable-background="new 0 0 256 256" height="80" viewBox="0 0 256 256" width="80" xmlns="http://www.w3.org/2000/svg"><g id="Layer_6"><g><path d="m230.8 132.2-18.5-74.4c-.3-1-1.3-1.7-2.3-1.5l-59.2 9.2c-1 .2-1.8 1.1-1.8 2.1l5 76.5c.1 2.3 2 4 4.3 3.9h.5l68.8-10.7c2.2-.3 3.8-2.5 3.4-4.7-.2-.1-.2-.3-.2-.4z" fill="#fc657e"/><path d="m153.9 144.1-5-76.5c0-1.1.7-2 1.8-2.1l26.8-4.2-5.8-23.2c-.4-1.3-1.7-2.2-3-2l-78 12.1c-1.4.2-2.4 1.4-2.3 2.8l6.5 100.7c.1 3 2.7 5.3 5.6 5.2.2 0 .4 0 .6-.1l57.5-8.9c-2.2.3-4.4-1.2-4.7-3.4.1-.1 0-.2 0-.4z" fill="#f5c84c"/><circle cx="108.9" cy="229.4" fill="#29589f" r="17.3"/><circle cx="194.3" cy="229.4" fill="#29589f" r="17.3"/><path d="m38.4 54.6c-.2 0-.4 0-.6 0l-29.5-2.9c-3.5-.3-6.1-3.4-5.8-6.9s3.4-6.1 6.9-5.8l29.6 2.9c3.5.3 6.1 3.5 5.7 7-.3 3.2-3 5.7-6.3 5.7z" fill="#fc657e"/><path d="m215.9 200.1h-119.9l10.4-15.1c3.7-5.4 9.4-9 15.9-10.1l79.9-13.1c3.3-.5 5.5-3.6 5-6.9-.5-2.9-3-5.1-6-5.1l-83.3 13.6c-8.7 2.1-16.3 7.3-21.4 14.6l-13.7 20c-2.8 4.1-1.8 9.7 2.3 12.5 1.5 1 3.3 1.6 5.1 1.6h125.7c3.3 0 6-2.7 6-6 .1-3.3-2.6-6-6-6z" fill="#dae6f1"/><circle cx="108.9" cy="229.4" fill="#5290db" r="6.2"/><circle cx="194.3" cy="229.4" fill="#5290db" r="6.2"/><path d="m253.2 158.7h-2.1v-2.1c0-1.5-1.3-2.8-2.8-2.8s-2.8 1.3-2.8 2.8v2.1h-2.1c-1.5 0-2.8 1.3-2.8 2.8s1.3 2.8 2.8 2.8h2.1v2.1c0 1.5 1.3 2.8 2.8 2.8s2.8-1.3 2.8-2.8v-2.1h2.1c1.5 0 2.8-1.3 2.8-2.8s-1.3-2.8-2.8-2.8z" fill="#70d6f9"/><path d="m88.3 30.5c-4-.7-7.1-3.8-7.9-7.7 0-.1-.1-.2-.2-.1-.1 0-.1.1-.1.1-.8 4-3.9 7-7.9 7.7-.1 0-.2.1-.1.2 0 .1.1.1.1.1 4 .7 7.1 3.8 7.9 7.7 0 .1.1.2.2.1.1 0 .1-.1.1-.1.8-4 3.9-7 7.9-7.7.1 0 .2-.1.1-.2 0-.1 0-.1-.1-.1z" fill="#f5c84c"/><circle cx="64" cy="52.8" fill="#fc657e" r="3"/><circle cx="57" cy="139.8" fill="#87d147" r="3"/><circle cx="238" cy="180.8" fill="#f5c84c" r="3"/><path d="m8 54.2 29.5 2.8c.5.1 1.1.1 1.6 0l43.9 100.7c3.2 7.4 10.9 11.9 18.9 10.9-2.9 2.3-5.4 5-7.5 8.1l-13.7 19.8c-3.6 5.2-2.3 12.4 3 16 1.9 1.3 4.2 2 6.5 2h5.5c-8.2 7.2-8.9 19.7-1.7 27.9s19.7 8.9 27.9 1.7 8.9-19.7 1.7-27.9c-.5-.6-1.1-1.2-1.7-1.7h59.2c-8.2 7.2-8.9 19.7-1.7 27.9s19.7 8.9 27.9 1.7 8.9-19.7 1.7-27.9c-.5-.6-1.1-1.2-1.7-1.7h8.5c4.7 0 8.5-3.8 8.5-8.5s-3.8-8.5-8.5-8.5h-115l7.7-11.1c3.3-4.8 8.5-8.1 14.2-9l79.9-13.1c4.6-.8 7.8-5.1 7-9.8-.2-1.2-.6-2.3-1.3-3.3l23.2-3.8c5.2-.8 9-5.3 9-10.6v-59.5c0-4.7-3.8-8.4-8.4-8.4-.1 0-.2 0-.2 0l-14.3.4-3-12.2c-.6-2.2-2.8-3.7-5.1-3.3l-6.1.9-.2-1.3c-2-12.9-14.1-21.8-27-19.8-1.4.2-2.7.6-4.1 1-1.1-.8-2.5-1.2-3.9-1l-8.8 1.4-.4-2.5c-2.5-16.5-18.1-27.8-34.6-25.2s-27.8 18.1-25.3 34.6l.4 2.5-9.1 1.4c-2.6.4-4.6 2.8-4.4 5.4l1.4 21.6-35.4 1-8.1-18.5c3.9-3 4.6-8.6 1.6-12.5-1.5-1.9-3.7-3.2-6.2-3.4l-29.6-2.8c-4.9-.5-9.2 3.1-9.7 8s3.1 9.2 8 9.6zm87.6 69.3-2.6-40.2 29.6 67.8-14 2.2zm7.8 30.6-2.6.4c-1.6.2-3.1-.8-3.3-2.4 0-.1 0-.3 0-.4l-.9-13.4zm58-94.1c-1.2-7.4 2.2-14.7 8.5-18.7l4.5 18-12.8 2zm50.1 14.4 5.4 12.4 11.4 45.9v.1c.2.9-.3 1.8-1.1 2-.1 0-.1 0-.2 0l-3.9.6-26.4-60.6zm-20.1.6 26.7 61.3-14 2.2-27.5-63zm16.1 71.3-1.4-3.2 14-2.2 1.3 3.1zm-38.1 6.3-1.5-3.5 14-2.2 1.5 3.4zm-3.5-8.2-11-25.3-2.6-40.3 27.6 63.5zm-7.6 1.1c-.9.1-1.7-.5-1.8-1.4 0-.1 0-.2 0-.2l-.7-10.2 5 11.4zm4.5 4.4 1.5 3.5-13.9 2.3-1.6-3.6zm-17.5 6.6-13.9 2.3-1.6-3.8 14-2.2zm43.2-7-1.5-3.3 14-2.2 1.4 3.2zm-17.3-74 27.7 63.7-14 2.2-28.5-65.5zm-19.5-4.4-.2-3.2 6-.9.6 3.9zm-2.8 34.4-12.6-29 10.7-.3zm-18-28.9 19 43.6 1.6 24c0 .8.2 1.5.5 2.3l-5.2.8-30.7-70.3zm-20.2.6 30.9 70.9-14 2.2-31.6-72.7zm13.9 78.6 1.7 3.8-13.9 2.3-1.7-3.9zm-.9 73.6c0 8.2-6.6 14.8-14.8 14.8s-14.8-6.6-14.8-14.8 6.6-14.8 14.8-14.8 14.8 6.6 14.8 14.8zm85.4 0c0 8.2-6.6 14.8-14.8 14.8s-14.8-6.6-14.8-14.8 6.6-14.8 14.8-14.8 14.8 6.6 14.8 14.8zm-4.4-74.1c.3 1.9-1 3.7-2.9 4l-79.9 13.1c-7.1 1.2-13.4 5.2-17.5 11.1l-10.4 15.2c-.8 1.1-.5 2.7.6 3.5.4.3.9.4 1.4.4h119.9c1.9 0 3.5 1.6 3.5 3.5s-1.6 3.5-3.5 3.5h-125.6c-3.6 0-6.5-2.9-6.5-6.5 0-1.3.4-2.6 1.2-3.7l13.7-19.8c4.7-6.8 11.8-11.7 19.9-13.6l83-13.6c1.5.1 2.9 1.3 3.1 2.9zm26.1-12.8-4.2.7-1.3-3 2.6-.4c3.6-.6 6.1-4 5.5-7.6 0-.2-.1-.5-.1-.7l-4.3-17.1 6.7 15.4v7.1c-.1 2.8-2.1 5.2-4.9 5.6zm1.3-68.6c1.9-.1 3.5 1.4 3.5 3.3v.1 40l-13.9-32-2.7-11zm-22.1-15.1 2.6 10.6-49.5 1.3-.7-4.6 36.9-5.7.8 5.1c.2 1.4 1.5 2.3 2.9 2.1s2.3-1.5 2.1-2.9l-.8-5.1zm-33-20.2c10.2-1.6 19.7 5.4 21.3 15.6l.2 1.3-19.2 3-4.8-19.3c.9-.3 1.7-.5 2.5-.6zm-12.9.8c-1.2 1.1-2.4 2.3-3.4 3.7l-.5-3.1zm-60.1 1.8c-2.2-13.8 7.2-26.9 21.1-29.1s26.9 7.2 29.1 21.1v.2l.4 2.5-50.2 7.8zm-12.9 9.6 9.1-1.4 1.2 7.5c.5 3.3 5.4 2.5 4.9-.8l-1.2-7.5 50.2-7.8 1.2 7.5c.1.6.4 1.1.9 1.5-1.2 3.5-1.5 7.3-.9 11l.2 1.3-6.3 1c-2.3.4-4 2.4-3.9 4.8l.2 3.4-54.4 1.5-1.4-21.8c0-.1.1-.2.2-.2zm-1.4 59.2-13.9-31.9 11.8-.3zm-19.3-31.7 20.2 46.5 1.8 27.2c.2 4.4 3.9 7.8 8.3 7.6.3 0 .6 0 .9-.1l3.9-.6 1.7 4-5.2.9c-6 1-11.9-2.2-14.4-7.8l-33.5-77.3zm-61.2-36.8 29.5 2.8c2.1.2 3.7 2.1 3.5 4.2s-2.1 3.7-4.2 3.5l-29.5-2.7c-2.1-.2-3.7-2.1-3.5-4.3.2-2.1 2.1-3.7 4.2-3.5z"/><path d="m108.9 238.1c4.8 0 8.7-3.9 8.7-8.7s-3.9-8.7-8.7-8.7-8.7 3.9-8.7 8.7 3.9 8.7 8.7 8.7zm0-12.4c2.1 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7c-2.1 0-3.7-1.7-3.7-3.7 0-2.1 1.7-3.7 3.7-3.7z"/><path d="m194.3 238.1c4.8 0 8.7-3.9 8.7-8.7s-3.9-8.7-8.7-8.7-8.7 3.9-8.7 8.7c0 4.8 3.9 8.7 8.7 8.7zm0-12.4c2.1 0 3.7 1.7 3.7 3.7 0 2.1-1.7 3.7-3.7 3.7-2.1 0-3.7-1.7-3.7-3.7 0-2.1 1.7-3.7 3.7-3.7z"/></g></g></svg>
                    </button>
                    <div class="px-4 py-4 text-white">
                        <h1>Shopping Cart</h1>
                    </div>
                </div>
                <div class="justify-center p-8">
                    <button class="zoom-icon focus:outline-none focus:shadow-outline focus:border-blue-300" v-on:click="toggleModalOrder()">
                        <svg id="filled_outline" height="80" viewBox="0 0 512 512" width="80" xmlns="http://www.w3.org/2000/svg" data-name="filled outline"><path d="m416 488v-216h-264l-19.32-24h-44.68l-24 24v216z" fill="#f7b023"/><path d="m112 24h272v352h-272z" fill="#afeaef"/><path d="m112 24v24h145.927a86.073 86.073 0 0 1 86.073 86.073v75.854a86.073 86.073 0 0 1 -86.073 86.073h-145.927v80h272v-352z" fill="#77d5d8"/><path d="m360 88h-24v-24h-32v24h-24v32h24v24h32v-24h24z" fill="#4abdcc"/><path d="m352 80h-24v-24h-32v24h-24v32h24v24h32v-24h24z" fill="#f44a2a"/><path d="m200 168h16v16h-16z" fill="#3b9daf"/><path d="m232 168h112v16h-112z" fill="#3b9daf"/><path d="m416 488h-352l72-168h352z" fill="#f9e48c"/><path d="m397.476 320a175.076 175.076 0 0 1 -160.921 106.111h-146.031l-26.524 61.889h352l72-168z" fill="#f7ce23"/><g fill="#3b9daf"><path d="m200 224h96v16h-96z"/><path d="m312 224h24v16h-24z"/><path d="m200 256h64v16h-64z"/><path d="m280 256h72v16h-72z"/></g><path d="m144 160h32v32h-32z" fill="#066991"/><path d="m144 232h32v32h-32z" fill="#066991"/><path d="m384 272h16v48h-16z" fill="#f99321"/><path d="m488 312h-64v-40a8 8 0 0 0 -8-8h-24v-240a8 8 0 0 0 -8-8h-272a8 8 0 0 0 -8 8v216h-16a8 8 0 0 0 -5.657 2.343l-24 24a8 8 0 0 0 -2.343 5.657v216h.012a7.973 7.973 0 0 0 7.988 8h352a8 8 0 0 0 7.354-4.849l72-168a8 8 0 0 0 -7.354-11.151zm-80-32v32h-16v-32zm-32-248v280h-240a8 8 0 0 0 -7.353 4.849l-8.647 20.175v-305.024zm-284.686 224h12.686v118.357l-32 74.667v-173.711zm319.411 224h-334.593l65.144-152h334.592z"/><path d="m272 120h16v16a8 8 0 0 0 8 8h32a8 8 0 0 0 8-8v-16h16a8 8 0 0 0 8-8v-32a8 8 0 0 0 -8-8h-16v-16a8 8 0 0 0 -8-8h-32a8 8 0 0 0 -8 8v16h-16a8 8 0 0 0 -8 8v32a8 8 0 0 0 8 8zm8-32h16a8 8 0 0 0 8-8v-16h16v16a8 8 0 0 0 8 8h16v16h-16a8 8 0 0 0 -8 8v16h-16v-16a8 8 0 0 0 -8-8h-16z"/><path d="m200 168h16v16h-16z"/><path d="m232 168h112v16h-112z"/><path d="m200 224h96v16h-96z"/><path d="m312 224h24v16h-24z"/><path d="m200 256h64v16h-64z"/><path d="m280 256h72v16h-72z"/><path d="m144 200h32a8 8 0 0 0 8-8v-32a8 8 0 0 0 -8-8h-32a8 8 0 0 0 -8 8v32a8 8 0 0 0 8 8zm8-32h16v16h-16z"/><path d="m144 272h32a8 8 0 0 0 8-8v-32a8 8 0 0 0 -8-8h-32a8 8 0 0 0 -8 8v32a8 8 0 0 0 8 8zm8-32h16v16h-16z"/></svg>                    </button>
                </div>
                <div class=" px-12 text-white">
                    <h1>Order History</h1>
                </div>
            </div>

            <div>
<!--                <div></div>-->
                <div class="flex">
                    <div class="col " v-for="column in columns">
                        <div class="p-6 max-w-sm rounded overflow-hidden shadow-lg p-6" v-for="product in column">
                            <img class="zoom object-contain h-48" :src="product.image_src">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ product.name }}</div>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    RM {{ product.price }}
                                </span>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded-full" @click="addProduct(product)">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <transition name="slide-fade" mode="out-in">
            <div v-if="showModalCart" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
                <div class="relative w-auto my-6 mx-auto max-w-6xl">
                    <!--content-->
                    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                        <!--header-->
                        <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t bg-blue-800">
                            <h3 class="text-white text-3xl font-semibold">
                                Cart
                            </h3>
                            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModalCart()">
                                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">×</span>
                            </button>
                        </div>
                        <!--body-->
                        <div class="content-center relative p-6 flex-auto">
                            <div class="flex justify-center my-6" v-if="Object.keys(cart.items).length > 0">
                                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                                    <div class="flex-1">
                                        <table class=" table-fixed w-full text-sm lg:text-base" cellspacing="0">
                                            <thead>
                                            <tr class="h-12 uppercase">
                                                <th class="text-left px-4 py-2">Product</th>
                                                <th class="text-left px-4 py-2">Product Type</th>
                                                <th class="hidden text-right md:table-cell">Unit price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="product in cart.items" >
                                                <td class="hidden pb-4 md:table-cell">
                                                    <p class="mb-2 md:ml-4">{{ product.product_name }}</p>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p class="mb-2 md:ml-4">{{ product.product_type }}</p>
                                                        <form action="" method="POST">
                                                            <button type="submit" class="text-gray-700 md:ml-4">
                                                                <small>(Remove item)</small>
                                                            </button>
                                                        </form>
                                                    </a>
                                                </td>
                                                <td class="hidden text-right md:table-cell">
                                                    <span class="text-sm lg:text-base font-medium">RM {{product.product_price}}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center my-6" v-else>
                                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                                    <div class="flex-1">
                                        <table class=" table-fixed w-full text-sm lg:text-base" cellspacing="0">
                                            <thead>
                                            </thead>
                                            <tbody class="justify-center">
                                            Add something to your cart
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--footer-->
                        <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                            <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" v-on:click="toggleModalCart()">
                                Close
                            </button>
                            <button class="text-blue-800 bg-transparent border border-solid border-blue-500 hover:bg-blue-800 hover:text-white active:bg-blue-800 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" @click="checkout(cart)">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="showModalCart" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
        </transition>

        <transition name="slide-fade" mode="out-in">
            <div v-if="showModalOrder" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
                <div class="relative w-auto my-6 mx-auto max-w-6xl">
                    <!--content-->
                    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                        <!--header-->
                        <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t bg-blue-800">
                            <h3 class="text-white text-3xl font-semibold">
                                Order History
                            </h3>
                            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModalOrder()">
                                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">×</span>
                            </button>
                        </div>
                        <!--body-->
                        <div class="content-center relative p-6 flex-auto">
                            <div class="flex justify-center my-6" v-if="Object.keys(orders).length > 0">
                                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                                    <div class="flex-1">
                                        <div class="accordion flex flex-col items-center justify-center">
                                            <div class="w-full" v-for="order in orders">
                                                <input type="checkbox" name="panel" :id="`panel-${order.id}`" class="hidden">
                                                <label :for="`panel-${order.id}`" class="relative block bg-blue-800 text-white p-4 shadow border-b border-grey">Order #{{ order.id }}</label>
                                                <div class="accordion__content overflow-hidden bg-grey-lighter">
                                                    <div class="accordion__body p-4">
                                                        <table class=" table-fixed w-full text-sm lg:text-base" cellspacing="0">
                                                            <thead>
                                                            <tr class="h-12 uppercase">
                                                                <th class="text-left px-4 py-2">Product</th>
                                                                <th class="text-left px-4 py-2">Product Type</th>
                                                                <th class="hidden text-right md:table-cell">Unit price</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="product in order.items" >
                                                                <td class="hidden pb-4 md:table-cell">
                                                                    <p class="mb-2 md:ml-4">{{ product.product_name }}</p>
                                                                </td>
                                                                <td>
                                                                    <a href="#">
                                                                        <p class="mb-2 md:ml-4">{{ product.product_type }}</p>
                                                                    </a>
                                                                </td>
                                                                <td class="hidden text-right md:table-cell">
                                                                    <span class="text-sm lg:text-base font-medium">RM {{product.product_price}}</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center my-6" v-else>
                                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                                    <div class="flex-1">
                                        <table class=" table-fixed w-full text-sm lg:text-base" cellspacing="0">
                                            <thead>
                                            </thead>
                                            <tbody class="justify-center">
                                            Order Something
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="showModalOrder" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
        </transition>
    </div>
</template>

<style scoped>
.col {
    margin: 10px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.slide-fade-enter-active {
    transition: all .3s ease;
}
.slide-fade-leave-active {
    transition: all .2s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
.zoom-icon {
    transition: transform .2s; /* Animation */
    margin: 0 auto;
}

.zoom-icon:hover {
    transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    /* Start the shake animation and make the animation last for 0.5 seconds */
    animation: shake 0.5s;

    /* When the animation is finished, start again */
    animation-iteration-count: infinite;
}

.zoom {
    padding: 25px;
    transition: transform .2s; /* Animation */
    margin: 0 auto;
}

.zoom:hover {
    transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

@keyframes shake {
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-1deg); }
    20% { transform: translate(-3px, 0px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(1deg); }
    50% { transform: translate(-1px, 2px) rotate(-1deg); }
    60% { transform: translate(-3px, 1px) rotate(0deg); }
    70% { transform: translate(3px, 1px) rotate(-1deg); }
    80% { transform: translate(-1px, -1px) rotate(1deg); }
    90% { transform: translate(1px, 2px) rotate(0deg); }
    100% { transform: translate(1px, -2px) rotate(-1deg); }
}

label:after {
    content: '+';
    position: absolute;
    right: 1em;
    color: #fff;
}

input:checked + label:after {
    content: '-';
    line-height: .8em;
}

.accordion__content{
    max-height: 0em;
    transition: all 0.4s cubic-bezier(0.865, 0.14, 0.095, 0.87);
}
input[name='panel']:checked ~ .accordion__content {
    /* Get this as close to what height you expect */
    max-height: 50em;
}
</style>

<script>
export default {
    name: "App",
    data() {
        return {
            cols:4,
            products: [],
            user:{},
            cart:[],
            orders:[],
            showModalCart: false,
            showModalOrder: false
        };
    },
    created() {
        axios.get("/api/products")
            .then(res => {
                this.products = res.data
            })
            .catch(err => console.error(err));
        axios.get("/api/cart")
            .then(res => {
                this.cart = res.data
            })
            .catch(err => console.error(err));
        axios.get("/api/orders")
            .then(res => {
                this.orders = res.data[0]
                console.log(this.orders[0].items)
            })
            .catch(err => console.error(err));


    },
    methods: {
        addProduct: function (product) {
            let payload = {
                id: product.id,
                name: product.name,
                type: product.type,
                price: product.price,
                cart_id: this.cart.id
            }
            axios.post('/api/add-to-cart', payload)
                .then(res => {
                    this.cart.items.push(res.data[0]);
                })
                .catch(err => console.error(err));
        },
        checkout: function(cart){
            let payload = {
                id: cart.id,
                items: cart.items,
                user_id: cart.user_id
            }
            axios.post("/api/checkout", payload)
                .then(res => {
                    console.log(res.data);
                    this.cart.items = [];
                })
            this.cart.items = [];
        },
        toggleModalCart: function(){
            this.showModalCart = !this.showModalCart;
        },
        toggleModalOrder: function(){
            this.showModalOrder = !this.showModalOrder;
        },
    },

    computed: {
        columns () {
            let columns = []
            let mid = Math.ceil(this.products.length / this.cols)
            for (let col = 0; col < this.cols; col++) {
                columns.push(this.products.slice(col * mid, col * mid + mid))
            }
            return columns
        }
    },

};
</script>
