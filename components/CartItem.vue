<template>
  <tr>
    <td class="pb-4 table-cell">
      <a href="#">
        <div
          class="h-20 w-20 bg-cover"
          :style="{ backgroundImage: 'url(' + product.imgLink + ')' }"
        ></div>
      </a>
    </td>
    <td>
      <a href="#">
        <p class="mb-2 md:ml-4">{{ product.title }}</p>
        <!-- <button class="text-gray-700 md:ml-4">
          <small @click="removeItem(product.key)">(Remove item)</small>
        </button> -->
      </a>
    </td>
    <td class="justify-center md:justify-end md:flex mt-6">
      <div class="w-20 h-10">
        <div class="relative flex flex-row w-full h-8">
          <input
            type="number"
            min="1"
            class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black"
            v-model="product.quantity"
          />
        </div>
      </div>
    </td>
    <td class="hidden text-right md:table-cell">
      <span class="text-sm lg:text-base font-medium">
        {{ product.price.toFixed(2) }}
      </span>
    </td>
    <td class="text-right">
      <span class="text-sm lg:text-base font-medium">
        {{ (product.quantity * product.price.toFixed(2)).toFixed(2) }}
      </span>
    </td>
  </tr>
</template>

<script>
import firebase from "firebase/app";
import "firebase/database";

export default {
  data: () => ({}),
  props: ["product"],
  methods: {
    removeItem(id) {
      this.$parent.productsInCart.splice(0, 1);

      console.log(id);

      // firebase
      //   .database()
      //   .ref("users/" + email + "/cart")
      //   .remove();
    },
  },
};
</script>