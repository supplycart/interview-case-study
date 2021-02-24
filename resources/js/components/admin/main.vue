<template>
        <div class="grid grid-cols-3 gap-2">
            <div class="bg-white m-2 p-3 rounded">
                <a href='/admin/orders'>Orders ({{orders.length}})</a>
            </div>
            <div class="bg-white m-2 p-3 rounded">
                <a href='/admin/products'>Products ({{products.length}})</a>
            </div>
            <div class="bg-white m-2 p-3 rounded">
                <a href='/admin/users'>Users ({{users.length}})</a>
            </div>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                user : null,
                orders : [],
                products : [],
                users : []
            }
        },
        mounted() {
            axios.get('/api/users/').then(response => this.users = response.data)
            axios.get('/api/products/').then(response => this.products = response.data)
            axios.get('/api/orders/').then(response => this.orders = response.data)
        }
    }
    </script>

    <style scoped>
    .big-text { font-size: 28px; }
    .product-box { border: 1px solid #cccccc; padding: 10px 15px; height: 20vh }
    </style>