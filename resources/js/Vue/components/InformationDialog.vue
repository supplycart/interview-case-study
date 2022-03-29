<template>
    <base-dialog :close="close" :is-open="isOpen">
        <div
            class="dialog max-w-xs"
        >
            <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
            >
                <ExclamationCircleIcon class="h-10 w-10 text-red-500 inline-block" v-if="error"/>
                <CheckCircleIcon v-else class="h-10 w-10 text-emerald-500 inline-block"/>
                {{ title }}
            </DialogTitle>
            <div class="my-4">
                <p class="text-sm text-gray-500">
                    {{ description }}
                </p>
            </div>

            <div class="mt-2">
                <button
                    type="button"
                    class="button"
                    @click="close()"
                >
                    Close
                </button>
            </div>
        </div>
    </base-dialog>

</template>

<script>
import {Dialog, DialogOverlay, DialogTitle, DialogDescription, TransitionChild, TransitionRoot} from "@headlessui/vue";
import BaseDialog from "./BaseDialog";
import {ExclamationCircleIcon, CheckCircleIcon} from "@heroicons/vue/solid";

export default {
    name: "InformationDialog",
    components: {BaseDialog, Dialog, DialogOverlay, DialogTitle, DialogDescription, TransitionChild, TransitionRoot, ExclamationCircleIcon, CheckCircleIcon},
    props: ["title", "description", "error", "isOpen"],
    emits: ["close"],
    methods: {
        close() {
            this.$emit("close");
        }
    }
}
</script>

<style scoped>

</style>
