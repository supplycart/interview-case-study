<template>
  <div class="c-app">
    <TheSidebar/>
    <CWrapper>
      <TheHeader :cart="cart" @updateCart="updateCart"/>
      <div class="c-body">
        <main class="c-main">
          <CContainer fluid>
            <transition name="fade">
              <router-view @updateCart="updateCart" ></router-view>
            </transition>
          </CContainer>
        </main>
        <TheFooter/>
      </div>
    </CWrapper>
  </div>
</template>

<script>
import TheSidebar from './TheSidebar'
import TheHeader from './TheHeader'
import TheFooter from './TheFooter'

export default {
  name: 'TheContainer',
  data: () => {
    return {
      cart: 0
    }
  },
  components: {
    TheSidebar,
    TheHeader,
    TheFooter
  },
  methods: {
    updateCart: function (value) {
      this.cart++;
    }
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
