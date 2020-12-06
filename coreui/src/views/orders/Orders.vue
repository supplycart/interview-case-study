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
            <h3>Order History</h3>
            <CDataTable
              hover
              :items="items"
              :fields="fields"
              :items-per-page="10"
              pagination
            >
              <template #order_id="{item}">
                <td>
                  <strong>{{item.id}}</strong>
                </td>
              </template>
              <template #no_of_items="{item}">
                <td>
                  <strong>{{item.products.length}}</strong>
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
                  <CButton v-if="you!=item.id" color="primary" @click="showOrder( item.id )">View</CButton>
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
      /*
      fields: [
        {key: 'author'},
        {key: 'title'},
        {key: 'content'},
        {key: 'applies_to_date'},
        {key: 'status'},
        {key: 'note_type'},
        {key: 'show'},
        {key: 'edit'},
        {key: 'delete'}
      ],
      */
      fields: ['order_id', 'no_of_items', 'created_at', 'updated_at', 'action'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      you: null,
      message: '',
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false
    }
  },
  computed: {
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
      axios.get( '/api/order?token=' + localStorage.getItem("api_token") )
      .then(function (response) {
        self.items = response.data;
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
      });
    },
    showOrder ( id ) {
      const noteLink = this.orderLink( id );
      this.$router.push({path: noteLink});
    },
    orderLink (id) {
      return `order/${id.toString()}`
    },
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
