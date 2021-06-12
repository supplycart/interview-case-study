<template>
  <div class="fixed top-0 left-0 w-full h-full bg-opacity-75 z-20 bg-gray-300 flex items-center justify-center">
    <div class="sm:w-3/5 w-11/12 h-4/5 bg-white p-3 border border-solid border-gray-500 relative overflow-auto">
      <div class="sm:text-lg md:text-xl font-bold mb-3 sticky top-0 pt-2 pb-2 bg-white">Your Cart</div>
      <div v-if="$store.state.cart.length == 0">Your cart is empty</div>

      <div v-else-if="checkout" v-for="(cart, cIndex) in $store.state.cart" :key="cIndex" class="border border-solid border-gray-500 p-3 flex items-center mb-2 rounded-md">
        <div class="flex w-full">
          <img class="h-20 w-20 mr-3 bg-black object-contain" :src="cart['product']['image']" alt="">
          <div class="whitespace-pre-wrap description">
            <div class="text-lg font-bold sm:text-xl">{{ cart['name'] }} <span class="text-sm">(RM {{ (cart['product']['price'] * $store.state.discount).toFixed(2) }}/pc)</span></div>
            <div class="mb-2">{{ cart['product']['description'] }}</div>
            <div v-for="(size, sIndex) in Object.keys(cart['sizes'])" :key="sIndex" class="flex pt-1" :class="[ cart['sizes'][size] > 0 ? 'block' : 'hidden' ]">
              <div class="size">{{ size }}</div>:
              <div class="size">{{ cart['sizes'][size] }}</div>
              <img class="h-5 w-5 cursor-pointer" @click="deleteClicked(size, cart)" src="../assets/delete.png" alt="">
            </div>
          </div>
        </div>
        <div class="text-right sub-total">
          RM
          <div class="font-bold sm:text-xl text-lg">{{ ((cart['product']['price'] * $store.state.discount) * Object.keys(cart['sizes']).reduce((a, b) => { return a + cart['sizes'][b] }, 0)).toFixed(2) }}</div>
        </div>
      </div>

      <div v-else>
        <label for="">Name</label>
        <input type="text" v-model="name">
        <div v-if="nameError" class="text-red-500 -mt-1 mb-2 ml-2">{{ nameError }}</div>
        <label for="">Address</label>
        <input type="text" v-model="address">
        <div v-if="addressError" class="text-red-500 -mt-1 mb-2 ml-2">{{ addressError }}</div>
      </div>

      <div v-if="$store.state.cart.length > 0" class="flex flex-col items-center sticky bottom-0 bg-white">
        <div class="border border-solid text-center border-gray-500 p-3 mb-2 w-full rounded-md">
          <div>Total</div>
          <div class="font-bold text-lg sm:text-xl">RM {{ $store.state.totalPrice.toFixed(2) }}</div>
        </div>
        <button @click="checkoutClicked(checkout ? 'checkout' : 'order')">{{ checkout ? 'Checkout' : 'Complete Order' }}</button>
        <button v-if="!checkout" @click="checkout = true" class="button-red mt-2">Back</button>
      </div>

      <img class="absolute top-3 right-3 h-5 w-5 sm:h-7 sm:w-7 cursor-pointer" @click="$emit('close')" src="../assets/close.png" alt="">
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      checkout: true,

      name: '',
      address: '',

      nameError: '',
      addressError: ''
    }
  },
  props: {
  },
  methods: {
    deleteClicked: function(size, cart) {
      cart['sizes'][size]--;
      this.$store.commit('countTotal');

      this.$activity.send(`Removed 1 ${cart['name']} from the cart`);

      if (Object.keys(cart['sizes']).reduce((a, b) => { return a + cart['sizes'][b] }, 0) == 0) {
        let index = this.$store.state.cart.indexOf(cart);
        this.$store.state.cart.splice(index, 1);
      }
    },
    checkoutClicked: async function(btn) {
      this.nameError = '';
      this.addressError = '';

      if (btn == 'checkout') {
        this.checkout = false;
        this.name = this.$cookies.get('user').fullName;
      } else {
        if (!this.name) {
          this.nameError = 'Please enter your name';
        }
        if (!this.address) {
          this.addressError = 'Please enter your address';
        }

        if (this.name && this.address) {
          let date = new Date();
          let orderID = `${date.getFullYear()}${date.getMonth()}${date.getDate()}${date.getHours()}${date.getMinutes()}${date.getSeconds()}`;
          let orders = [];
          this.$store.state.cart.forEach((c) => {
            Object.keys(c['sizes']).forEach((s) => {
              if (c['sizes'][s] > 0) {
                orders.push({
                  orderid: orderID,
                  userid: this.$cookies.get('user').userID,
                  name: c['name'],
                  size: s,
                  quantity: c['sizes'][s],
                  price: this.$store.state.totalPrice,
                  orderat: date
                });
              }
            });
          });

          var submitOrder = await this.$axios.post('/Orders/CreateOrder', orders);
          if (submitOrder.data) {
            await this.$swal({
              icon: 'success',
              title: 'Order Completed',
              html: `Thank you ${this.name} for your order!<br /><br/>Your order id is ${orderID}`
            });

            this.$activity.send(`Order created with order id ${orderID}`);

            this.$store.state.cart = [];
            this.$emit('close');
            this.$store.commit('countTotal');
          } else {
            await this.$swal({
              icon: 'error',
              title: 'Order Not Completed',
              html: `There was an error completing your order.<br />Please try again`
            });
          }
        }
      }
    }
  },
  mounted() {
  }
};
</script>

<style lang="scss" scoped>
.sub-total {
  min-width: 90px;
}

.description {
  width: 100%;
  max-width: calc(100% - 90px);
}

.size {
  min-width: 30px;
}
</style>