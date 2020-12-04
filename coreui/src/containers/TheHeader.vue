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
        <CDropdown 
          toggler-content
          color="light"
          :caret="false"
        >
          <template #toggler-content >
            <h6 class="m-0">Cart  <CIcon class="ml-1" name="cil-basket"/></h6>
          </template>
        </CDropdown>
      </CHeaderNavItem>
    </CHeaderNav>

  </CHeader>
</template>

<script>
import CMenu from './Menu'
import axios from 'axios'
import TheHeaderDropdownAccnt from './TheHeaderDropdownAccnt'

export default {
  name: 'TheHeader',
  data: () => {
    return {
      items: [],
    }
  },
  components: {
    TheHeaderDropdownAccnt,
    CMenu
  },
  updated: function() {
    this.getCartItems();
  },
  mounted: function() {
    this.getCartItems();
  },
  methods: {
    getCartItems () {
      axios.get(  '/api/cart?token=' + localStorage.getItem("api_token") )
      .then(function (response) {
        console.log(response);
        self.items = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },
  }
}
</script>