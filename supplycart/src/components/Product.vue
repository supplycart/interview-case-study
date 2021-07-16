<template>
  <div class = "product">
    <h3>{{product.id}}. {{product.name}}</h3>
    <p>{{product.price}}</p>
  </div>
</template>

<script>
export default {
    name: "Product",
    props: {
        product: Object
    }
}
</script>

<style>

</style>