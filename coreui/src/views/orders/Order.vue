<template>
  <CRow>
    <CCol col="12" lg="6">
      <CCard no-header>
        <CCardBody>
          <h3>Order ID:  {{ $route.params.id }}</h3>
          <br>
          <h4>Items:</h4>
          <ul>
            <li class="row" v-for="item in order.products" :key="item.id">- {{ item.name }} x {{ item.pivot.amount }} <div class="ml-auto mr-4">- RM {{ item.price.amount.toFixed(2) }}</div></li>
          </ul>

          <h4 class="row mx-2">Total price: <div class="ml-auto">RM{{ totalPrice.toFixed(2) }}</div></h4>
          <br>

          <CButton color="primary" @click="goBack">Back</CButton>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  name: 'User',
  props: {
    caption: {
      type: String,
      default: 'User id',
    },
  },
  data: () => {
    return {
      order: [],
      totalPrice: 0
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/users'})
    }
  },
  mounted: function(){
    let self = this;
    axios.get(  '/api/order/' + self.$route.params.id + '?token=' + localStorage.getItem("api_token"))
    .then(function (response) {
      self.order = response.data;
      self.order.products.forEach(i => self.totalPrice = self.totalPrice + (i.price.amount * i.pivot.amount));
    }).catch(function (error) {
      console.log(error);
      self.$router.push({ path: '/pages/404' });
    });

  }
}


</script>
