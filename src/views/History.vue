<template>
    <div class="history">
        This is order history {{ items }}
        <!-- <div class="product-container" v-for="item in items" :key="item.id">
            {{ item }}
            <img src="https://via.placeholder.com/200x120" alt="">
            <div>{{ item.title }}</div>
            <div>{{ item.author }}</div>
            <div>
                <div>{{ item.review }} Star</div>
            </div>
        </div> -->
    </div>
</template>

<script>
export default {
    props: ['newItem']
}
</script>

<style>

</style>