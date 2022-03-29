<template>
    <div class="absolute left-0 top-0 z-50 w-full h-full bg-gray-300/50 flex justify-center items-center cursor-wait">
        <Spinner class="w-10 h-10 fill-blue-400"/>
    </div>
</template>

<script>
import Spinner from "./Spinner";
export default {
    name: "LoadingOverlay",
    components: {Spinner}
}
</script>

<style scoped>

</style>
