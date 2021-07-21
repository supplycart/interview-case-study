<template>
    <div class = "p-5 m-5 bg-white shadow-md rounded-lg ">   
        <h3 class="font-medium">Order {{pastOrder.id}} made on {{pastOrder.date}}</h3>
        <br> 
        <div class="item">
            <div class="item-summary">
                <div class="item-name">
                    <ol class="list-decimal pl-5">
                        <li v-for="item in pastOrder.products" :key="item.id">
                             {{ item.name }}
                        </li>
                    </ol>
                </div>
                <div class="item-qty">
                    <ol>
                        <li v-for="item in pastOrder.products" :key="item.id">
                            x {{ item.qty }}
                        </li>
                    </ol>
                </div>
            </div>
            <div class="item-details ">
                <ol>
                    <li v-for="item in pastOrder.products" :key="item.id">
                        {{ item.price }}
                    </li>
                </ol>
                <br>
                <hr>
                <br>
                <p>{{pastOrder.price}} (Total)</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PastOrder",
    props: {
        pastOrder: Object
    }
}
</script>

<style>
img {
  max-width: 80%;
  max-height: 80%;
        /* display: block;
        margin: 0 auto; */
}

.item {
  display: grid;
  grid-template-columns: 1fr 1fr;
  column-gap: 20px;
  /* place-items: center; */
}

.item-summary {
    display: grid;
    grid-template-columns: 1fr 0.5fr;
    column-gap: 10px;
}
</style>