<template>
    <!--
      This example requires updating your template:
  
      ```
      <html class="h-full bg-gray-100">
      <body class="h-full">
      ```
    -->
    <div class="min-h-full">
        <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img
                                class="h-8 w-8"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company"
                            />
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="item.href"
                                    @click="this[item.clickFunction]()"
                                    :class="[
                                        item.current
                                            ? 'bg-gray-900 text-white'
                                            : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                        'rounded-md px-3 py-2 text-sm font-medium',
                                    ]"
                                    :aria-current="
                                        item.current ? 'page' : undefined
                                    "
                                    >{{ item.name }}</a
                                >
                                <Menu
                                    as="div"
                                    class="relative inline-block text-left"
                                >
                                    <div>
                                        <MenuButton
                                            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                        >
                                            Role
                                            <ChevronDownIcon
                                                class="-mr-1 h-5 w-5 text-gray-400"
                                                aria-hidden="true"
                                            />
                                        </MenuButton>
                                    </div>

                                    <transition
                                        enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95"
                                    >
                                        <MenuItems
                                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        >
                                            <div class="py-1">
                                                <MenuItem v-slot="{ active }">
                                                    <a
                                                        href="javasctipt:void(0)"
                                                        @click="changeRole(1)"
                                                        :class="[
                                                            active
                                                                ? 'bg-gray-100 text-gray-900'
                                                                : 'text-gray-700',
                                                            'block px-4 py-2 text-sm',
                                                        ]"
                                                        >New Customer</a
                                                    >
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <a
                                                        href="javasctipt:void(0)"
                                                        @click="changeRole(2)"
                                                        :class="[
                                                            active
                                                                ? 'bg-gray-100 text-gray-900'
                                                                : 'text-gray-700',
                                                            'block px-4 py-2 text-sm',
                                                        ]"
                                                        >Normal Customer</a
                                                    >
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <a
                                                        href="javasctipt:void(0)"
                                                        @click="changeRole(3)"
                                                        :class="[
                                                            active
                                                                ? 'bg-gray-100 text-gray-900'
                                                                : 'text-gray-700',
                                                            'block px-4 py-2 text-sm',
                                                        ]"
                                                        >Royal Customer</a
                                                    >
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <button
                                type="button"
                                @click="showCart()"
                                class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                <span class="absolute -inset-1.5" />
                                <ShoppingBagIcon
                                    class="h-6 w-6"
                                    aria-hidden="true"
                                />
                            </button>

                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-3">
                                <div>
                                    <MenuButton
                                        class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    >
                                        <span class="absolute -inset-1.5" />
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            :src="user.imageUrl"
                                            alt=""
                                        />
                                    </MenuButton>
                                </div>
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <MenuItem
                                            v-for="item in userNavigation"
                                            :key="item.name"
                                            v-slot="{ active }"
                                        >
                                            <a
                                                :href="item.href"
                                                @click="
                                                    this[item.clickFunction]()
                                                "
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'block px-4 py-2 text-sm text-gray-700',
                                                ]"
                                                >{{ item.name }}</a
                                            >
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <DisclosureButton
                            class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <span class="absolute -inset-0.5" />
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon
                                v-if="!open"
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                            <XMarkIcon
                                v-else
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                        </DisclosureButton>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="md:hidden">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <DisclosureButton
                        v-for="item in navigation"
                        :key="item.name"
                        as="a"
                        :href="item.href"
                        :class="[
                            item.current
                                ? 'bg-gray-900 text-white'
                                : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                            'block rounded-md px-3 py-2 text-base font-medium',
                        ]"
                        :aria-current="item.current ? 'page' : undefined"
                        >{{ item.name }}</DisclosureButton
                    >
                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <img
                                class="h-10 w-10 rounded-full"
                                :src="user.imageUrl"
                                alt=""
                            />
                        </div>
                        <div class="ml-3">
                            <div
                                class="text-base font-medium leading-none text-white"
                            >
                                {{ user.name }}
                            </div>
                            <div
                                class="text-sm font-medium leading-none text-gray-400"
                            >
                                {{ user.email }}
                            </div>
                        </div>
                        <button
                            type="button"
                            @click="showCart()"
                            class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <span class="absolute -inset-1.5" />
                            <ShoppingBagIcon
                                class="h-6 w-6"
                                aria-hidden="true"
                            />
                        </button>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <DisclosureButton
                            v-for="item in userNavigation"
                            :key="item.name"
                            as="a"
                            :href="item.href"
                            @click="this[item.clickFunction]()"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            >{{ item.name }}</DisclosureButton
                        >
                    </div>
                </div>
            </DisclosurePanel>
        </Disclosure>

        <TransitionRoot as="template" :show="cartOpen">
            <Dialog as="div" class="relative z-10" @close="cartOpen = false">
                <TransitionChild
                    as="template"
                    enter="ease-in-out duration-500"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in-out duration-500"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div
                            class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                        >
                            <TransitionChild
                                as="template"
                                enter="transform transition ease-in-out duration-500 sm:duration-700"
                                enter-from="translate-x-full"
                                enter-to="translate-x-0"
                                leave="transform transition ease-in-out duration-500 sm:duration-700"
                                leave-from="translate-x-0"
                                leave-to="translate-x-full"
                            >
                                <DialogPanel
                                    class="pointer-events-auto relative w-screen max-w-md"
                                >
                                    <TransitionChild
                                        as="template"
                                        enter="ease-in-out duration-500"
                                        enter-from="opacity-0"
                                        enter-to="opacity-100"
                                        leave="ease-in-out duration-500"
                                        leave-from="opacity-100"
                                        leave-to="opacity-0"
                                    >
                                        <div
                                            class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4"
                                        >
                                            <button
                                                type="button"
                                                class="relative rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                @click="cartOpen = false"
                                            >
                                                <span
                                                    class="absolute -inset-2.5"
                                                />
                                                <span class="sr-only"
                                                    >Close panel</span
                                                >
                                                <XMarkIcon
                                                    class="h-6 w-6"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </TransitionChild>
                                    <div
                                        class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl"
                                    >
                                        <div class="px-4 sm:px-6">
                                            <DialogTitle
                                                class="text-base font-semibold leading-6 text-gray-900"
                                                >Shopping Cart</DialogTitle
                                            >
                                        </div>
                                        <div
                                            class="relative mt-6 flex-1 px-4 sm:px-6"
                                            v-if="cartLoading"
                                        >
                                            <div
                                                class="max-w-sm w-full mx-auto mb-6"
                                            >
                                                <div
                                                    class="animate-pulse flex space-x-4"
                                                >
                                                    <div
                                                        class="bg-slate-200 h-100 w-10"
                                                    ></div>
                                                    <div
                                                        class="flex-1 space-y-6 py-1"
                                                    >
                                                        <div class="space-y-3">
                                                            <div
                                                                class="grid grid-cols-3 gap-4"
                                                            >
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-2"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-1"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-start-3 col-end-4"
                                                                ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="max-w-sm w-full mx-auto mb-6"
                                            >
                                                <div
                                                    class="animate-pulse flex space-x-4"
                                                >
                                                    <div
                                                        class="bg-slate-200 h-100 w-10"
                                                    ></div>
                                                    <div
                                                        class="flex-1 space-y-6 py-1"
                                                    >
                                                        <div class="space-y-3">
                                                            <div
                                                                class="grid grid-cols-3 gap-4"
                                                            >
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-2"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-1"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-start-3 col-end-4"
                                                                ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="max-w-sm w-full mx-auto mb-6"
                                            >
                                                <div
                                                    class="animate-pulse flex space-x-4"
                                                >
                                                    <div
                                                        class="bg-slate-200 h-100 w-10"
                                                    ></div>
                                                    <div
                                                        class="flex-1 space-y-6 py-1"
                                                    >
                                                        <div class="space-y-3">
                                                            <div
                                                                class="grid grid-cols-3 gap-4"
                                                            >
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-2"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-1"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-start-3 col-end-4"
                                                                ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="relative mt-6 flex-1 px-4 sm:px-6"
                                            v-else
                                        >
                                            <div
                                                class="max-w-sm w-full mx-auto mb-6"
                                                v-for="(
                                                    item, itemIndex
                                                ) of cart"
                                                :key="'item' + itemIndex"
                                            >
                                                <div class="flex space-x-4">
                                                    <img
                                                        src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg"
                                                        alt="Front of men's Basic Tee in black."
                                                        class="h-100 w-10"
                                                    />
                                                    <div
                                                        class="flex-1 space-y-6 py-1"
                                                    >
                                                        <div class="space-y-3">
                                                            <div
                                                                class="grid grid-cols-3 gap-3"
                                                            >
                                                                <div
                                                                    class="col-span-2"
                                                                    v-text="
                                                                        item
                                                                            .product
                                                                            .name
                                                                    "
                                                                ></div>
                                                                <div
                                                                    class="col-span-1 text-right"
                                                                >
                                                                    <small>
                                                                        RM</small
                                                                    >{{
                                                                        item
                                                                            .product
                                                                            .price
                                                                    }}
                                                                </div>
                                                                <div
                                                                    class="col-start-3 col-end-4 text-right"
                                                                >
                                                                    <small
                                                                        class="text-slate-400"
                                                                        >Qty: </small
                                                                    >{{
                                                                        item.quantity
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button
                                                type="button"
                                                class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                                :disabled="cartTotal <= 0"
                                                @click="checkout()"
                                            >
                                                Checkout <small>RM</small
                                                >{{ cartTotal }}
                                            </button>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <TransitionRoot as="template" :show="orderOpen">
            <Dialog as="div" class="relative z-10" @close="orderOpen = false">
                <TransitionChild
                    as="template"
                    enter="ease-in-out duration-500"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in-out duration-500"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div
                            class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                        >
                            <TransitionChild
                                as="template"
                                enter="transform transition ease-in-out duration-500 sm:duration-700"
                                enter-from="translate-x-full"
                                enter-to="translate-x-0"
                                leave="transform transition ease-in-out duration-500 sm:duration-700"
                                leave-from="translate-x-0"
                                leave-to="translate-x-full"
                            >
                                <DialogPanel
                                    class="pointer-events-auto relative w-screen max-w-md"
                                >
                                    <TransitionChild
                                        as="template"
                                        enter="ease-in-out duration-500"
                                        enter-from="opacity-0"
                                        enter-to="opacity-100"
                                        leave="ease-in-out duration-500"
                                        leave-from="opacity-100"
                                        leave-to="opacity-0"
                                    >
                                        <div
                                            class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4"
                                        >
                                            <button
                                                type="button"
                                                class="relative rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                @click="orderOpen = false"
                                            >
                                                <span
                                                    class="absolute -inset-2.5"
                                                />
                                                <span class="sr-only"
                                                    >Close panel</span
                                                >
                                                <XMarkIcon
                                                    class="h-6 w-6"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </TransitionChild>
                                    <div
                                        class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl"
                                    >
                                        <div class="px-4 sm:px-6">
                                            <DialogTitle
                                                class="text-base font-semibold leading-6 text-gray-900"
                                                >Order History</DialogTitle
                                            >
                                        </div>
                                        <div
                                            class="relative mt-6 flex-1 px-4 sm:px-6"
                                            v-if="orderLoading"
                                        >
                                            <div
                                                class="max-w-sm w-full mx-auto mb-6"
                                            >
                                                <div
                                                    class="animate-pulse flex space-x-4"
                                                >
                                                    <div
                                                        class="bg-slate-200 h-100 w-10"
                                                    ></div>
                                                    <div
                                                        class="flex-1 space-y-6 py-1"
                                                    >
                                                        <div class="space-y-3">
                                                            <div
                                                                class="grid grid-cols-3 gap-4"
                                                            >
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-2"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-1"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-start-3 col-end-4"
                                                                ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="max-w-sm w-full mx-auto mb-6"
                                            >
                                                <div
                                                    class="animate-pulse flex space-x-4"
                                                >
                                                    <div
                                                        class="bg-slate-200 h-100 w-10"
                                                    ></div>
                                                    <div
                                                        class="flex-1 space-y-6 py-1"
                                                    >
                                                        <div class="space-y-3">
                                                            <div
                                                                class="grid grid-cols-3 gap-4"
                                                            >
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-2"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-1"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-start-3 col-end-4"
                                                                ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="max-w-sm w-full mx-auto mb-6"
                                            >
                                                <div
                                                    class="animate-pulse flex space-x-4"
                                                >
                                                    <div
                                                        class="bg-slate-200 h-100 w-10"
                                                    ></div>
                                                    <div
                                                        class="flex-1 space-y-6 py-1"
                                                    >
                                                        <div class="space-y-3">
                                                            <div
                                                                class="grid grid-cols-3 gap-4"
                                                            >
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-2"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-span-1"
                                                                ></div>
                                                                <div
                                                                    class="h-2 bg-slate-200 rounded col-start-3 col-end-4"
                                                                ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="relative mt-6 flex-1 px-4 sm:px-6"
                                            v-else
                                        >
                                            <template
                                                v-for="(
                                                    order, orderIndex
                                                ) of orders"
                                                :key="'card' + orderIndex"
                                            >
                                                <div
                                                    class="max-w-sm mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                                                >
                                                    <div
                                                        class="max-w-sm w-full mx-auto mb-6"
                                                        v-for="(
                                                            item, itemIndex
                                                        ) of order.snapshot"
                                                        :key="
                                                            'item' + itemIndex
                                                        "
                                                    >
                                                        <div
                                                            class="flex space-x-4"
                                                        >
                                                            <img
                                                                src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg"
                                                                alt="Front of men's Basic Tee in black."
                                                                class="h-100 w-10"
                                                            />
                                                            <div
                                                                class="flex-1 space-y-6 py-1"
                                                            >
                                                                <div
                                                                    class="space-y-3"
                                                                >
                                                                    <div
                                                                        class="grid grid-cols-3 gap-3"
                                                                    >
                                                                        <div
                                                                            class="col-span-2"
                                                                            v-text="
                                                                                item
                                                                                    .product
                                                                                    .name
                                                                            "
                                                                        ></div>
                                                                        <div
                                                                            class="col-span-1 text-right"
                                                                        >
                                                                            <small>
                                                                                RM</small
                                                                            >{{
                                                                                item
                                                                                    .product
                                                                                    .price
                                                                            }}
                                                                        </div>
                                                                        <div
                                                                            class="col-start-3 col-end-4 text-right"
                                                                        >
                                                                            <small
                                                                                class="text-slate-400"
                                                                                >Qty: </small
                                                                            >{{
                                                                                item.quantity
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400"
                                                        ><small>Total: RM</small
                                                        >{{
                                                            order.total_price
                                                        }}</span
                                                    >
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <main>
            <div class="mx-auto max-w-7xl pt-6 sm:px-6 lg:px-8">
                <template v-if="!attributeLoading && attributes.length > 0">
                    <span class="mr-3">Filter By:</span>
                    <button
                        type="button"
                        v-for="(attr, attrIndex) of attributes"
                        :key="attrIndex"
                        v-text="attr.name"
                        @click="retrieveProduct(attr.id)"
                        class="mr-2 px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    />
                    <button
                        type="button"
                        v-text="'Clear'"
                        @click="retrieveProduct(null)"
                        class="mr-2 px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    />
                </template>
                <template v-else-if="attributeLoading"> Loading... </template>
            </div>

            <div
                v-if="productLoading"
                class="mx-auto max-w-7xl pb-6 sm:px-6 lg:px-8"
            >
                <div
                    class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
                >
                    <div class="animate-pulse flex space-x-4">
                        <div class="flex-1 space-y-6 py-1">
                            <div class="h-80 bg-slate-200 rounded"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-2"
                                    ></div>
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-1"
                                    ></div>
                                </div>
                                <div class="h-2 bg-slate-200 rounded"></div>
                            </div>
                        </div>
                    </div>
                    <div class="animate-pulse flex space-x-4">
                        <div class="flex-1 space-y-6 py-1">
                            <div class="h-80 bg-slate-200 rounded"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-2"
                                    ></div>
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-1"
                                    ></div>
                                </div>
                                <div class="h-2 bg-slate-200 rounded"></div>
                            </div>
                        </div>
                    </div>
                    <div class="animate-pulse flex space-x-4">
                        <div class="flex-1 space-y-6 py-1">
                            <div class="h-80 bg-slate-200 rounded"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-2"
                                    ></div>
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-1"
                                    ></div>
                                </div>
                                <div class="h-2 bg-slate-200 rounded"></div>
                            </div>
                        </div>
                    </div>
                    <div class="animate-pulse flex space-x-4">
                        <div class="flex-1 space-y-6 py-1">
                            <div class="h-80 bg-slate-200 rounded"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-2"
                                    ></div>
                                    <div
                                        class="h-2 bg-slate-200 rounded col-span-1"
                                    ></div>
                                </div>
                                <div class="h-2 bg-slate-200 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="mx-auto max-w-7xl pb-6 sm:px-6 lg:px-8">
                <div
                    class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
                >
                    <div
                        v-for="product in products"
                        :key="product.id"
                        class="group relative"
                    >
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80"
                        >
                            <img
                                src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg"
                                alt="Front of men's Basic Tee in black."
                                class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                            />
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a
                                        href="javascript:void(0)"
                                        @click="addCart(product.id)"
                                    >
                                        <span
                                            aria-hidden="true"
                                            class="absolute inset-0"
                                        />
                                        {{ product.name }}
                                        <span
                                            v-for="(
                                                attribute, attributeIndex
                                            ) of product.product_attributes"
                                            :key="'attr' + attributeIndex"
                                            class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                                            v-text="attribute.attribute.name"
                                        />
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ product.description }}
                                </p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">
                                <small>RM</small>{{ product.price }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Bars3Icon,
    ShoppingBagIcon,
    XMarkIcon,
    PlusCircleIcon,
    ChevronDownIcon,
} from "@heroicons/vue/24/outline";

export default {
    components: {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        Dialog,
        DialogPanel,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        Bars3Icon,
        ShoppingBagIcon,
        XMarkIcon,
        PlusCircleIcon,
        ChevronDownIcon,
    },
    data() {
        return {
            user: {
                name: "Tom Cook",
                email: "tom@example.com",
                imageUrl:
                    "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            },
            navigation: [{ name: "Dashboard", href: "#", current: true }],
            userNavigation: [
                {
                    name: "Order History",
                    href: "javascript:void(0)",
                    clickFunction: "showOrder",
                },
                { name: "Sign out", href: "logout" },
            ],

            attributeLoading: true,
            attributes: [],

            productLoading: true,
            products: [],

            cartOpen: false,
            cartLoading: true,
            cart: [],
            cartTotal: 0,

            orderOpen: false,
            orderLoading: true,
            orders: [],
        };
    },
    mounted() {
        this.retrieveAttribute();
        this.retrieveProduct(null);
    },
    methods: {
        changeRole(id) {
            axios
                .post(this.PROJECT_PATH + "change-role", { role_id: id })
                .then(() => {})
                .catch(() => {
                    alert("error");
                })
                .finally(() => {
                    this.retrieveProduct();
                });
        },

        retrieveAttribute() {
            this.attributeLoading = true;
            axios
                .get(this.PROJECT_PATH + "attributes")
                .then((resp) => {
                    this.attributes = resp.data;
                })
                .catch(() => {
                    alert("error");
                })
                .finally(() => {
                    this.attributeLoading = false;
                });
        },

        retrieveProduct(attr_id) {
            this.productLoading = true;

            axios
                .get(
                    this.PROJECT_PATH +
                        "products" +
                        (attr_id ? "/" + attr_id : "")
                )
                .then((resp) => {
                    this.products = resp.data;
                })
                .catch(() => {
                    alert("error");
                })
                .finally(() => {
                    this.productLoading = false;
                });
        },

        showOrder() {
            this.orderOpen = true;
            this.orderLoading = true;

            axios
                .get(this.PROJECT_PATH + "order")
                .then((resp) => {
                    this.orders = resp.data.orders;
                })
                .catch(() => {
                    alert("error");
                })
                .finally(() => {
                    this.orderLoading = false;
                });
        },

        showCart() {
            this.cartOpen = true;
            this.cartLoading = true;

            axios
                .get(this.PROJECT_PATH + "cart")
                .then((resp) => {
                    this.cart = resp.data.cart;
                    this.cartTotal = resp.data.total;
                })
                .catch(() => {
                    alert("error");
                })
                .finally(() => {
                    this.cartLoading = false;
                });
        },
        addCart(product_id) {
            let toast_id = toast.loading("Adding...", {
                position: toast.POSITION.TOP_RIGHT,
            });
            axios
                .post(this.PROJECT_PATH + "add-cart", {
                    product_id: product_id,
                })
                .then(() => {
                    toast.update(toast_id, {
                        render: "Added to cart",
                        autoClose: 2000,
                        type: "success",
                        isLoading: false,
                    });
                })
                .catch(() => {
                    toast.update(toast_id, {
                        render: "Failed",
                        autoClose: 2000,
                        type: "error",
                        isLoading: false,
                    });
                });
        },

        checkout() {
            let toast_id = toast.loading("Processing...", {
                position: toast.POSITION.TOP_RIGHT,
            });

            axios
                .post(this.PROJECT_PATH + "checkout-cart")
                .then(() => {
                    toast.update(toast_id, {
                        render: "Checkout successfully",
                        autoClose: 2000,
                        type: "success",
                        isLoading: false,
                    });
                })
                .catch(() => {
                    toast.update(toast_id, {
                        render: "Something went wrong",
                        autoClose: 2000,
                        type: "error",
                        isLoading: false,
                    });
                })
                .finally(() => {
                    this.showCart();
                });
        },
    },
};
</script>