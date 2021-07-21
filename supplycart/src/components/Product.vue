<template>
  <div class = "p-5 m-5 product bg-white shadow-md rounded-lg item ">
    <div class="item-summary">
      <img :src="product.img" :alt="product.name">
      <h3>{{product.id}}. {{product.name}}</h3>
    </div>
    <div class="item-details ">
      <p>{{product.desc}}</p>
      <br>
      <p>Price: {{product.price}}</p>
    </div>
    <div class="text-right item-add-to-cart">
      <button @click="addedProduct()" class="mt-8 bg-green-100 rounded-lg shadow-lg px-4 py-1 hover:bg-green-200">Add to cart</button>
    </div>
  </div>
</template>

<script>
export default {
    name: "Product",
    props: {
        product: Object
    },
    methods:{
      addedProduct() {
        alert("Added product into cart")
        console.log("add product into cart success")
      }
    }
}
</script>

<style scoped>
img {
  max-width: 80%;
  max-height: 80%;
        /* display: block;
        margin: 0 auto; */
}

.item {
  display: grid;
  grid-template-columns: 1fr 1fr 0.5fr;
  column-gap: 20px;
  /* place-items: center; */
}

.item-add-to-cart {
  align-self: end;
}
</style>