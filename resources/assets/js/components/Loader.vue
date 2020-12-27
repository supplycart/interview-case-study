<template>
    <div class="h-96 flex justify-center">
        <div id="loader" class="m-6 rounded-full w-20 h-20 absolute border-16 border-solid border-black" ></div>
    </div>
</template>
<style scoped>
    #loader {
        border-color: #f3f3f3;
        border-top-color: #3498db;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>