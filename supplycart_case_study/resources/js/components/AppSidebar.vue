<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, ShoppingCart, ReceiptText, Logs } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import MiniCart from '@/components/MiniCart.vue'
import { useCartStore } from '@/stores/cart'
import { computed } from 'vue'

const cart = useCartStore()
const totalItems = computed(() => cart.totalItems())

const mainNavItems: NavItem[] = [
    {
        title: 'Product',
        href: '/products',
        icon: LayoutGrid,
    },
    {
        title: 'Cart',
        href: '/carts',
        icon: ShoppingCart,
        badge: totalItems
    },
    {
        title: 'Order History',
        href: '/orders/history',
        icon: ReceiptText,
    },
    {
        title: 'Activity Log',
        href: '/activity-log',
        icon: Logs,
    },
];

</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>

                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>

            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
