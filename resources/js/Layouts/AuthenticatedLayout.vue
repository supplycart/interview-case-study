<script setup>
import {
    Bell,
    CircleUser,
    Home,
    LineChart,
    Menu,
    Package,
    Package2,
    Search,
    ShoppingCart,
    Users,
} from 'lucide-vue-next'

import { Badge } from '@/Components/ui/badge'
import { Button } from '@/Components/ui/button'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import { Input } from '@/Components/ui/input'
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet'
import { Link, usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user
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
                            href="/"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
                        >
                            <Home class="h-4 w-4" />
                            Dashboard
                        </a>
                        <a
                            href="#"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
                        >
                            <ShoppingCart class="h-4 w-4" />
                            Orders
                            <Badge
                                class="ml-auto flex h-6 w-6 shrink-0 items-center justify-center rounded-full"
                            >
                                6
                            </Badge>
                        </a>
                        <a
                            href="#"
                            class="flex items-center gap-3 rounded-lg bg-muted px-3 py-2 text-primary transition-all hover:text-primary"
                        >
                            <Package class="h-4 w-4" />
                            Products
                        </a>
                        <a
                            href="#"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
                        >
                            <Users class="h-4 w-4" />
                            Customers
                        </a>
                        <a
                            href="#"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
                        >
                            <LineChart class="h-4 w-4" />
                            Analytics
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
                                href="#"
                                class="flex items-center gap-2 text-lg font-semibold"
                            >
                                <Package2 class="h-6 w-6" />
                                <span class="sr-only">SupplyCart</span>
                            </a>
                            <a
                                href="#"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                            >
                                <Home class="h-5 w-5" />
                                Dashboard
                            </a>
                            <a
                                href="#"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl bg-muted px-3 py-2 text-foreground hover:text-foreground"
                            >
                                <ShoppingCart class="h-5 w-5" />
                                Orders
                                <Badge
                                    class="ml-auto flex h-6 w-6 shrink-0 items-center justify-center rounded-full"
                                >
                                    6
                                </Badge>
                            </a>
                            <a
                                href="#"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                            >
                                <Package class="h-5 w-5" />
                                Products
                            </a>
                            <a
                                href="#"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                            >
                                <Users class="h-5 w-5" />
                                Customers
                            </a>
                            <a
                                href="#"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                            >
                                <LineChart class="h-5 w-5" />
                                Analytics
                            </a>
                        </nav>
                    </SheetContent>
                </Sheet>
                <div class="w-full flex-1">
                    <form>
                        <div class="relative">
                            <Search
                                class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground"
                            />
                            <Input
                                type="search"
                                placeholder="Search products..."
                                class="w-full appearance-none bg-background pl-8 shadow-none md:w-2/3 lg:w-1/3"
                            />
                        </div>
                    </form>
                </div>
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
</template>
