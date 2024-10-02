<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import {
    ChevronRight,
    CircleUser,
    Menu,
    Package,
    Package2,
    ShoppingCart,
} from 'lucide-vue-next'
import { computed, onMounted } from 'vue'

import checkout from '@/API/checkout'
import getCart from '@/API/getCart'
import getOrders from '@/API/getOrders'
import { Badge } from '@/Components/ui/badge'
import { Button } from '@/Components/ui/button'
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/Components/ui/dialog'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet'
import {
    Table,
    TableBody,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import Toaster from '@/Components/ui/toast/Toaster.vue'
import { useCartStore } from '@/Stores/cartStore'
import { useOrderStore } from '@/Stores/orderStore'

const user = usePage().props.auth.user
const page = usePage().url

const cartStore = useCartStore()
const cart = computed(() => cartStore.cart)

const orderStore = useOrderStore()
const orders = computed(() => orderStore.orders)

// Fetch orders and cart when component is mounted
onMounted(() => {
    getOrders()
    getCart()
})
</script>

<template>
    <div
        class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
    >
        <div class="hidden border-r bg-muted/40 md:block">
            <div
                class="flex h-full max-h-screen flex-col gap-2 fixed md:max-w-[220px] lg:max-w-[280px] w-full"
            >
                <div
                    class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6"
                >
                    <a
                        href="/dashboard"
                        class="flex items-center gap-2 font-semibold"
                    >
                        <Package2 class="h-6 w-6" />
                        <span class="">SupplyCart</span>
                    </a>
                </div>
                <div class="flex-1">
                    <nav
                        class="grid items-start px-2 text-sm font-medium lg:px-4"
                    >
                        <a
                            href="/dashboard"
                            :class="{
                                'flex items-center gap-3 rounded-lg px-3 py-2 transition-all hover:text-primary': true,
                                'bg-muted text-primary': page === '/dashboard',
                            }"
                        >
                            <Package class="h-4 w-4" />
                            Products
                        </a>
                        <a
                            href="/orders"
                            :class="{
                                'flex items-center gap-3 rounded-lg px-3 py-2 transition-all hover:text-primary': true,
                                'bg-muted text-primary': page === '/orders',
                            }"
                        >
                            <ShoppingCart class="h-4 w-4" />
                            Orders
                            <Badge
                                class="ml-auto flex h-6 w-6 shrink-0 items-center justify-center rounded-full"
                            >
                                {{ orders?.orders?.length || 0 }}
                            </Badge>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="flex flex-col max-w-[100dvw]">
            <header
                class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6"
            >
                <Sheet>
                    <SheetTrigger as-child>
                        <Button
                            variant="outline"
                            size="icon"
                            class="shrink-0 md:hidden"
                        >
                            <Menu class="h-5 w-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="flex flex-col">
                        <nav class="grid gap-2 text-lg font-medium">
                            <a
                                href="/dashboard"
                                class="flex items-center gap-2 text-lg font-semibold mb-4"
                            >
                                <Package2 class="h-6 w-6" />
                                <span class="sr-only">SupplyCart</span>
                            </a>
                            <a
                                href="/dashboard"
                                :class="{
                                    'mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 hover:text-foreground': true,
                                    'bg-muted text-foreground':
                                        page === '/dashboard',
                                    'text-muted-foreground':
                                        page !== '/dashboard',
                                }"
                            >
                                <Package class="h-5 w-5" />
                                Products
                            </a>
                            <a
                                href="/orders"
                                :class="{
                                    'mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 hover:text-foreground': true,
                                    'bg-muted text-foreground':
                                        page === '/orders',
                                    'text-muted-foreground': page !== '/orders',
                                }"
                            >
                                <ShoppingCart class="h-5 w-5" />
                                Orders
                                <Badge
                                    class="ml-auto flex h-6 w-6 shrink-0 items-center justify-center rounded-full"
                                >
                                    {{ orders?.orders?.length || 0 }}
                                </Badge>
                            </a>
                        </nav>
                    </SheetContent>
                </Sheet>
                <div class="w-full flex-1"></div>
                <Dialog>
                    <DialogTrigger>
                        <Button
                            variant="secondary"
                            size="icon"
                            class="rounded-full w-max gap-4 p-4"
                        >
                            <ShoppingCart class="h-5 w-5" />
                            <Badge class="">{{ cart.total_items || 0 }}</Badge>
                            <span class="sr-only">Toggle cart</span>
                        </Button>
                    </DialogTrigger>
                    <DialogContent class="max-w-max">
                        <DialogHeader>
                            <DialogTitle>
                                {{
                                    cart?.total_items !== 0
                                        ? 'Cart'
                                        : 'Your cart is empty'
                                }}
                            </DialogTitle>
                            <DialogDescription>
                                {{
                                    cart?.total_items !== 0
                                        ? 'Here is your cart, check one more time before purchasing.'
                                        : 'Add a product, and come back here.'
                                }}
                            </DialogDescription>
                        </DialogHeader>

                        <Table v-if="cart?.total_items !== 0">
                            <TableHeader>
                                <TableRow>
                                    <TableHead class="w-[100px] sm:table-cell">
                                        <span class="sr-only">img</span>
                                    </TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Brand</TableHead>
                                    <TableHead>Category</TableHead>
                                    <TableHead>Price</TableHead>
                                    <TableHead>Quantity</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody
                                v-for="(item, index) in cart['cart_items']"
                                :key="item.product_id"
                            >
                                <TableRow>
                                    <TableCell class="sm:table-cell">
                                        <img
                                            alt="Product image"
                                            class="aspect-square rounded-md object-cover min-w-[64px]"
                                            height="64"
                                            src="https://picsum.photos/100"
                                            width="64"
                                        />
                                    </TableCell>
                                    <TableCell class="font-medium">
                                        {{ item.product_name }}
                                    </TableCell>
                                    <TableCell>
                                        {{ item.product_brand }}
                                    </TableCell>
                                    <TableCell>
                                        {{ item.product_category }}
                                    </TableCell>
                                    <TableCell>
                                        {{
                                            new Intl.NumberFormat('en-US', {
                                                style: 'currency',
                                                currency: item.price.currency,
                                            }).format(item.price.amount)
                                        }}
                                    </TableCell>
                                    <TableCell>
                                        {{ item.quantity }}
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                            <TableFooter class="bg-background" colspan="6">
                                <TableCell class="text-end" colspan="6">
                                    Total: ${{ cart.total_price.toFixed(2) }}
                                </TableCell>
                            </TableFooter>
                        </Table>

                        <DialogFooter v-if="cart?.total_items !== 0">
                            <Button
                                class="flex flex-row items-center justify-center"
                                @click="checkout"
                            >
                                Proceed to Checkout
                                <ChevronRight class="w-[22px] h-[22px]" />
                            </Button>
                        </DialogFooter>
                    </DialogContent>
                </Dialog>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button
                            variant="secondary"
                            size="icon"
                            class="rounded-full"
                        >
                            <CircleUser class="h-5 w-5" />
                            <span class="sr-only">Toggle user menu</span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>{{ user.name }}</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="w-full text-sm text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            <DropdownMenuItem class="w-full cursor-pointer">
                                Log Out
                            </DropdownMenuItem>
                        </Link>
                    </DropdownMenuContent>
                </DropdownMenu>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                <slot />
            </main>
        </div>
    </div>
    <Toaster />
</template>
