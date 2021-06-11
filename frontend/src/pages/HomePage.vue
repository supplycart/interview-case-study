<template>
  <div class="w-full">
    <div class="h-12 w-full flex items-center bg-white sticky top-0 header-shadow z-10">
      <img class="h-9 w-9 absolute right-14 cursor-pointer" @click="showCart = true" src="../assets/cart.png" alt="">
      <div v-if="$store.state.totalCart > 0" class="rounded-full absolute z-10 pointer-events-none bg-blue-400 h-5 w-5 flex items-center justify-center bottom-2 right-20 font-bold text-xs">{{ $store.state.totalCart }}</div>
      <img class="h-9 w-9 absolute right-2 cursor-pointer" src="../assets/user.png" alt="" @focus="showUserMenu = true" @blur="canCloseUserMenu ? showUserMenu = false : showUserMenu = true" tabindex="1">
      <div v-if="showUserMenu" class="fixed p-2 right-2 w-1/4 bg-white top-12 border border-gray-400 rounded-md border-solid"
        @mouseover="canCloseUserMenu = false" @mouseleave="canCloseUserMenu = true">
        <div>Hi {{ $cookies.get('user').userID }}</div>
        <button class="w-full my-2" @click="orderHistoryClicked">{{ $store.state.gotoHomeChild }}</button>
        <button class="w-full my-2 button-red" @click="logoutClicked">Logout</button>
      </div>
    </div>
    <div v-if="$store.state.verified" class="bg-yellow-200 p-3" @click="test">
      You email 
    </div>
    <router-view />

    <Cart v-if="showCart" @close="showCart = false" />
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      showCart: false,

      showUserMenu: false,
      canCloseUserMenu: true,
    }
  },
  props: {
  },
  methods: {
    orderHistoryClicked: function(e) {
      if (e.target.innerHTML == 'Products') {
        this.$router.push('/Home');
      } else {
        this.$router.push('/Home/History');
      }

      this.showUserMenu = false;
    },
    logoutClicked: function() {
      this.$cookies.remove('user');
      this.$router.push('/');

      this.showUserMenu = false;
    },
    test: function() {
      let user = this.$cookies.get('user');
      user.verifycode = null;
      this.$cookies.set('user', user);
      this.$store.state.verified = null;
    }
  },
  async mounted() {
    if (!this.$cookies.isKey('user')) {
      this.$router.push('/');
      return;
    }

    this.$store.state.verified = this.$cookies.get('user').verifycode;
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