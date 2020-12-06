<template>
  <CHeader fixed with-subheader light>
    <CToggler
      in-header
      class="ml-3 d-lg-none"
      @click="$store.commit('toggleSidebarMobile')"
    />
    <CToggler
      in-header
      class="ml-3 d-md-down-none"
      @click="$store.commit('toggleSidebarDesktop')"
    />
    <CHeaderBrand class="mx-auto d-lg-none" to="/">
      <CIcon name="logo" height="48" alt="Logo"/>
    </CHeaderBrand>

    <CMenu/>

    <CHeaderNav class="mr-4">
      <CHeaderNavItem class="d-md-down-none mx-2">
        <CButton
          color="warning"
          variant="outline"
          size="lg"
          @click="logout()"
        >
          <h6 class="m-0">Log Out </h6>
        </CButton>

        <CButton
          @click="warningModal = true"
          color="light"
        >
          <h6 class="m-0"><CIcon class="ml-1" name="cil-basket"/> Cart <CBadge color="primary" shape="pill">{{ computedCount }}</CBadge></h6>
        </CButton>


      </CHeaderNavItem>
    </CHeaderNav>

    <CModal
      title="Cart"
      color="primary"
      :show.sync="warningModal"
      footer
    >
      <div class="flex" v-for="item in cItems" :key="item.id">
        
        <div class="flex-1">
          {{ item.name }} 
        </div>
        
        <div class="flex-1">
          {{ item.price.amount }}
        </div>
        
        <!-- <CButton
          size="sm"
          color="secondary"
          class="m-2 ml-auto"
          @click="removeItem(item.pivot.id)"
        >
          -
        </CButton>
        <CBadge color="light" shape="pill" class="mx-2">
          {{ item.pivot.amount }}
        </CBadge>
        <CButton
          size="sm"
          color="secondary"
          class="m-2"
          @click="addItem(item.pivot.id)"
        >
          +
        </CButton> -->
      </div>

      <template #footer>
        <div>
          <CButton
            size="lg"
            color="primary"
            variant="outline"
            class="m-2"
            @click="checkOut(cItems[0].pivot.cart_id)"
          >
            <b>Check out</b>
          </CButton>
        </div>
      </template>
    </CModal>
  </CHeader>
</template>

<script>
import CMenu from './Menu'
import axios from 'axios'
import TheHeaderDropdownAccnt from './TheHeaderDropdownAccnt'

export default {
  name: 'TheHeader',
  props: ['cart'],
  data: () => {
    return {
      items: [],
      warningModal: false
    }
  },
  computed: {
    cItems: {
      get: function () {
        return this.items;
      },
      set: function (i) {
        this.items = i;
      }
    },
    computedCount: function() {
      let count = 0;
      this.items.forEach(i => count = count + i.pivot.amount);
      return count;
    }
  },
  components: {
    TheHeaderDropdownAccnt,
    CMenu
  },
  mounted: function() {
    this.getCartItems();
  },
  methods: {
    getCartItems: function() {
      let self = this;
      this.count = 0;
      axios.get(  '/api/cart?token=' + localStorage.getItem("api_token") )
      .then(function (response) {
        let items = response.data;
        self.items = items;
        console.log(items);
        return items;
      }).catch(function (error) {
        console.log(error);
      });
    },
    addItem: function(id) {
      let self = this;
      this.count = 0;
      axios.put(  '/api/cart/addItem/' + id + '?token=' + localStorage.getItem("api_token"),{
        _method: 'PUT'
      })
      .then(function (response) {
          self.message = 'Successfully added.';
          self.$emit('updateCart', 1);
      }).catch(function (error) {
        console.log(error);
      });
    },
    removeItem: function(id) {
      let self = this;
      this.count = 0;
      axios.put(  '/api/cart/removeItem/' + id + '?token=' + localStorage.getItem("api_token") )
      .then(function (response) {
          self.message = 'Successfully removed.';
          self.$emit('updateCart', 1);
      }).catch(function (error) {
        console.log(error);
      });
    },
    logout(){
      let self = this;
      axios.post('/api/logout?token=' + localStorage.getItem("api_token"),{})
      .then(function (response) {
        self.$router.push({ path: '/login' });
      }).catch(function (error) {
        console.log(error); 
      });
    },
    checkOut: function(id) {
      let self = this;
      this.count = 0;
      axios.post(  '/api/order/' + id + '?token=' + localStorage.getItem("api_token"),{
        _method: 'POST'
      })
      .then(function (response) {
        self.message = 'Successfully checked out.';
        self.$emit('updateCart', 1);
        self.warningModal = false;
        self.$router.push({ path: '/order' });
        self.showAlert();
      }).catch(function (error) {
        console.log(error);
      });
    },
  },
  watch: {
    cart: function(){
      this.getCartItems();
    }
  }
}
</script>