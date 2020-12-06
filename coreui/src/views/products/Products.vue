<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
      <CCard>
        <CCardBody>
          <CAlert
            :show.sync="dismissCountDown"
            color="primary"
            fade
          >
            ({{dismissCountDown}}) {{ message }}
          </CAlert>
            <h3>Products</h3>
            <CDataTable
              hover
              :items="computedItems"
              :fields="fields"
              :items-per-page="10"
              column-filter
              table-filter
              sorter
              pagination
              :loading="loading"
            >
              <template #category="{item}">
                <td>
                  <strong>{{item.categories[0].name}}</strong>
                </td>
              </template>
              <template #brand="{item}">
                <td>
                  <strong>{{item.brands[0].name}}</strong>
                </td>
              </template>
              <template #price="{item}">
                <td>
                  <strong>RM {{ item.price.amount.toFixed(2) }}</strong>
                </td>
              </template>
              <template #created_at-filter="{item}">
                <td>

                </td>     
              </template>
              <template #updated_at-filter="{item}">
                <td>

                </td>     
              </template>
              <template #price-filter="{item}">
                <td>

                </td>     
              </template>
              <template #action-filter="{item}">
                <td>

                </td>     
              </template>
              <template #created_at="{item}">
                <td>
                  <strong>{{ formatDate(item.created_at) }}</strong>
                </td>
              </template>
              <template #updated_at="{item}">
                <td>
                  <strong>{{ formatDate(item.updated_at) }}</strong>
                </td>
              </template>
              <template #show="{item}">
                <td>
                  <CButton color="primary" @click="showNote( item.id )">Show</CButton>
                </td>
              </template>
              <template #edit="{item}">
                <td>
                  <CButton color="primary" @click="editNote( item.id )">Edit</CButton>
                </td>
              </template>
              <template #action="{item}">
                <td>
                  <CButton v-if="you!=item.id" color="success" @click="addToCart( item )">Add to Cart</CButton>
                </td>
              </template>
            </CDataTable>
        </CCardBody>  
      </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Notes',
  data: () => {
    return {
      items: [],
      fields: ['name', 'price', 'brand', 'category', 'created_at', 'updated_at', 'action'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      you: null,
      message: '',
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      loading: false
    }
  },
  computed: {
    computedItems () {
      return this.items.map(item => {
        return { 
          ...item, 
          category: item.categories[0].name, 
          brand: item.brands[0].name,
        }
      })
    },
  },
  methods: {
    getRowCount (items) {
      return items.length
    },
    noteLink (id) {
      return `notes/${id.toString()}`
    },
    editLink (id) {
      return `notes/${id.toString()}/edit`
    },
    showNote ( id ) {
      const noteLink = this.noteLink( id );
      this.$router.push({path: noteLink});
    },
    editNote ( id ) {
      const editLink = this.editLink( id );
      this.$router.push({path: editLink});
    },
    addToCart ( item ) {
      let id = item.id;
      let self = this;
      let noteId = id;
      axios.post(  '/api/cart/add/' + id + '?token=' + localStorage.getItem("api_token"), {
        _method: 'POST'
      })
      .then(function (response) {
          self.message = 'Successfully added ' + item.name + ' to cart.';
          self.showAlert();
          self.getNotes();
          self.$emit('updateCart', 1);
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    createNote () {
      this.$router.push({path: 'notes/create'});
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getNotes (){
      let self = this;
      self.loading = true;
      axios.get(  '/api/products?token=' + localStorage.getItem("api_token") )
      .then(function (response) {
        self.items = response.data;
        console.log(self.items);
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
      self.loading = false;
    },
    formatDate(date) {
      let d = new Date(date);
      return d;
    }
  },
  mounted: function(){
    this.getNotes();
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>
