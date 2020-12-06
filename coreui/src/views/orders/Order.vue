<template>
  <CRow>
    <CCol col="12" lg="6">
      <CCard no-header>
        <CCardBody>
          <h3>Order id:  {{ $route.params.id }}</h3>
          <br>
          <h4>Items:</h4>
          <ul>
            <li v-for="item in order.products" :key="item.id">{{ item.name }} x {{ item.pivot.amount }}</li>
          </ul>

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
      default: 'User id'
    },
  },
  data: () => {
    return {
      order: [],
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
    }).catch(function (error) {
      console.log(error);
      self.$router.push({ path: '/login' });
    });
  }
}


</script>
