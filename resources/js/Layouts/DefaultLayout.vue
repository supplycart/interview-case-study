<script setup>
import { UserCircleIcon } from "@heroicons/vue/24/solid";
</script>

<template>
    <div class="min-h-full bg-slate-100 h-full">
        <div class="h-16 drop-shadow-md bg-slate-50">
            <div class="mx-5 flex h-16 items-center justify-between">
                <!-- Action links -->
                <div class="flex items-center justify-between">
                    <p class="pr-10">SupplyCart</p>
                    <Link
                        v-for="link in menuLinks"
                        :href="link.url"
                        class="px-2 data-active:font-bold data-active:bg-lime-500 data-active:text-white data-active:rounded-full"
                        :data-ui="$page.url === link.url ? 'active' : ''"
                        >{{ link.name }}
                    </Link>
                </div>
                <div class="flex">
                    <div><UserCircleIcon class="h-8 w-8 text-lime-500" /></div>
                </div>
            </div>
        </div>
        <div class="m-10">
            <div v-if="$page.props.auth.user" class="mb-2">
                <p>
                    Welcome
                    <span class="font-bold">
                        {{ $page.props.auth.user.name }} </span
                    >!
                    <span
                        v-if="$page.props.auth.user.membership_level"
                        class="rounded-full px-2 font-medium"
                        :style="{
                            background:
                                $page.props.auth.user.membership_level.bg_color,
                            color: $page.props.auth.user.text_color,
                        }"
                    >
                        {{ $page.props.auth.user.membership_level.name }}
                    </span>
                    <span class="text-sm">
                        (You're entitled for a
                        {{ $page.props.auth.user.membership_level.discount }}%
                        discount!)
                    </span>
                </p>
            </div>
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            menuLinks: [
                {
                    name: "Products",
                    url: "/products",
                },
                {
                    name: "Order History",
                    url: "/orders",
                },
                {
                    name: "Cart",
                    url: "/carts",
                },
            ],
        };
    },
};
</script>
