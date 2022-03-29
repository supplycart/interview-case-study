<template>
    <div ref="container">
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" :close="close" :open="isOpen">
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="min-h-screen px-4 text-center flex justify-center items-center">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <DialogOverlay class="fixed inset-0 bg-gray-900/30" @click="close"/>
                        </TransitionChild>

                        <span class="inline-block h-screen align-middle" aria-hidden="true">
              &#8203;
            </span>

                        <TransitionChild
                            as="div"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <slot/>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script>
import {Dialog, DialogOverlay, DialogTitle, DialogDescription, TransitionChild, TransitionRoot} from "@headlessui/vue";

export default {
    name: "BaseDialog",
    components: {Dialog, DialogOverlay, DialogTitle, DialogDescription, TransitionChild, TransitionRoot},
    props: ["isOpen", "close"],

}
</script>

<style scoped>

</style>
