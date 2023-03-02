<script setup>
import { CheckCircleIcon } from "@heroicons/vue/24/solid";
import { TransitionRoot } from "@headlessui/vue";
</script>

<template>
    <TransitionRoot
        :show="showToast"
        enter="transition-opacity ease-in-out duration-500 delay-[200ms]"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity duration-150"
        leave-from="opacity-100"
        leave-to="opacity-0"
    >
        <div
            id="toast-bottom-left"
            class="fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-gray-100 divide-x divide-gray-200 rounded-lg shadow bottom-5 right-5"
            role="alert"
        >
            <div class="text-sm font-normal">
                <div class="flex items-center">
                    <CheckCircleIcon class="h-8 w-8 text-lime-500 mr-2" />
                    {{ toastText }}
                </div>
            </div>
        </div>
    </TransitionRoot>
</template>

<script>
export default {
    props: {
        showToast: false,
        toastText: String,
    },
};
</script>
