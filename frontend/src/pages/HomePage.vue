<template>
  <div class="w-full">
    <div class="h-12 w-full flex items-center bg-white sticky top-0 header-shadow z-10">
      <img class="h-9 w-9 absolute right-4 cursor-pointer" @click="showCart = true" src="../assets/cart.png" alt="">
      <div v-if="$store.state.totalCart > 0" class="rounded-full absolute z-10 pointer-events-none bg-blue-400 h-5 w-5 flex items-center justify-center bottom-2 right-8 font-bold text-xs">{{ $store.state.totalCart }}</div>
    </div>
    <div class="p-3 w-full">
      <!-- <div class="flex items-center">
        <input id="malayCB" type="checkbox" v-model="malayChecked">
        <label for="malayCB" class="ml-1 mr-3">Malay</label>
        <input id="chineseCB" type="checkbox" v-model="chineseChecked">
        <label for="chineseCB" class="ml-1 mr-3">Chinese</label>
        <input id="indianCB" type="checkbox" v-model="indianChecked">
        <label for="indianCB" class="ml-1 mr-3">Indian</label>
      </div> -->
      <div v-for="(cat, catIndex) in allProducts" :key="catIndex">
        <div class="mt-3 mb-2 font-bold text-center sm:text-justify sm:text-lg text-sm w-full">{{ cat['group'] }}</div>
        <div class="flex flex-wrap w-full sm:justify-start justify-center">
          <div v-for="(prod, prodIndex) in cat['products']" :key="prodIndex" class="border-black border-solid border h-72 m-2 w-52 p-2 relative flex flex-col">
            <img :src="prod['image']" class="w-full max-h-32 bg-black object-contain">
            <div>{{ prod['name'] }}</div>
            <div>RM {{ prod['price'].toFixed(2) }}</div>
            <div class="flex items-center">
              <div v-for="(size, sizeIndex) in prod['sizes'].split(',')" :key="sizeIndex" class="flex items-center">
                <input type="radio" :value="`${prod['name']}_${sizeIndex}`" v-model="prod['selectedSize']" :id="`${prod['name']}_${sizeIndex}`">
                <label :for="`${prod['name']}_${sizeIndex}`" class="ml-1 mr-3">{{ size.toUpperCase() }}</label>
              </div>
            </div>
            <div v-if="prod['selectedSize']">Availability: {{ prod['available'].split(',')[parseInt(prod['selectedSize'].split('_')[1])] }} item(s)</div>
            <button :disabled="!prod['selectedSize']" class="m-auto" @click="addToCart(prod)">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <Cart v-if="showCart" @close="showCart = false" />
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      malayChecked: true,
      chineseChecked: true,
      indianChecked: true,

      showCart: false,

      allProducts: [],
    }
  },
  props: {
  },
  methods: {
    addToCart: function(prod) {
      let index = parseInt(prod['selectedSize'].split('_')[1]);
      let allSizes = prod['sizes'].split(',').map(s => s.toUpperCase());
      let size = allSizes[index];
      
      let inCart = this.$store.state.cart.filter(c => c['name'] == prod['name']);
      
      if (inCart.length > 0) {
        inCart[0]['sizes'][size]++;
      } else {
        let addProd = { product: prod, name: prod['name'] };
        let sizes = {};
        allSizes.forEach(s => sizes[s] = s == size ? 1 : 0);
        addProd['sizes'] = sizes;
        this.$store.state.cart.push(addProd);
      }

      this.$store.commit('countTotal');
    }
  },
  async mounted() {
    if (!this.$cookies.isKey('user')) {
      this.$router.push('/');
      return;
    }
    this.allProducts = (await this.$axios.get('/Products/GetProducts')).data;
  },
  watch: {
    showCart: function(val) {
      document.getElementsByTagName('body')[0].style.overflow = val ? 'hidden' : 'auto';
      // if (val) {

      // } else {

      // }
    }
  }
};
</script>

<style lang="scss" scoped>

</style>