(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{217:function(t,e,n){"use strict";var o=n(79);n.n(o).a},218:function(t,e,n){(t.exports=n(21)(!1)).push([t.i,"\n.card-body[data-v-4a91541a] table > tbody > tr > td {\n  cursor: pointer;\n}\n",""])},518:function(t,e,n){"use strict";n.r(e);var o=n(2),r=n.n(o);function i(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,o)}return n}function s(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var a={name:"Notes",data:function(){return{items:[],fields:["name","price","brand","category","created_at","updated_at","action"],currentPage:1,perPage:5,totalRows:0,you:null,message:"",showMessage:!1,dismissSecs:7,dismissCountDown:0,showDismissibleAlert:!1}},computed:{computedItems:function(){return this.items.map((function(t){return function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?i(n,!0).forEach((function(e){s(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):i(n).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},t,{category:t.categories[0].name,brand:t.brands[0].name})}))}},methods:{getRowCount:function(t){return t.length},noteLink:function(t){return"notes/".concat(t.toString())},editLink:function(t){return"notes/".concat(t.toString(),"/edit")},showNote:function(t){var e=this.noteLink(t);this.$router.push({path:e})},editNote:function(t){var e=this.editLink(t);this.$router.push({path:e})},addToCart:function(t){var e=t.id,n=this;r.a.post("/api/cart/add/"+e+"?token="+localStorage.getItem("api_token"),{_method:"POST"}).then((function(e){n.message="Successfully added "+t.name+" to cart.",n.showAlert(),n.getNotes(),n.$emit("updateCart",1)})).catch((function(t){console.log(t)}))},createNote:function(){this.$router.push({path:"notes/create"})},countDownChanged:function(t){this.dismissCountDown=t},showAlert:function(){this.dismissCountDown=this.dismissSecs},getNotes:function(){var t=this;r.a.get("/api/products?token="+localStorage.getItem("api_token")).then((function(e){t.items=e.data,console.log(t.items)})).catch((function(t){console.log(t)}))}},mounted:function(){this.getNotes()}},c=(n(217),n(0)),u=Object(c.a)(a,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("CRow",[n("CCol",{attrs:{col:"12",xl:"12"}},[n("transition",{attrs:{name:"slide"}},[n("CCard",[n("CCardBody",[n("CAlert",{attrs:{show:t.dismissCountDown,color:"primary",fade:""},on:{"update:show":function(e){t.dismissCountDown=e}}},[t._v("\n            ("+t._s(t.dismissCountDown)+") "+t._s(t.message)+"\n          ")]),t._v(" "),n("h3",[t._v("Products")]),t._v(" "),n("CDataTable",{attrs:{hover:"",items:t.computedItems,fields:t.fields,"items-per-page":10,"column-filter":"","table-filter":"",sorter:"",pagination:""},scopedSlots:t._u([{key:"category",fn:function(e){var o=e.item;return[n("td",[n("strong",[t._v(t._s(o.categories[0].name))])])]}},{key:"brand",fn:function(e){var o=e.item;return[n("td",[n("strong",[t._v(t._s(o.brands[0].name))])])]}},{key:"price",fn:function(e){var o=e.item;return[n("td",[n("strong",[t._v(t._s(o.price.amount.toFixed(2)))])])]}},{key:"show",fn:function(e){var o=e.item;return[n("td",[n("CButton",{attrs:{color:"primary"},on:{click:function(e){return t.showNote(o.id)}}},[t._v("Show")])],1)]}},{key:"edit",fn:function(e){var o=e.item;return[n("td",[n("CButton",{attrs:{color:"primary"},on:{click:function(e){return t.editNote(o.id)}}},[t._v("Edit")])],1)]}},{key:"action",fn:function(e){var o=e.item;return[n("td",[t.you!=o.id?n("CButton",{attrs:{color:"success"},on:{click:function(e){return t.addToCart(o)}}},[t._v("Add to Cart")]):t._e()],1)]}}])})],1)],1)],1)],1)],1)}),[],!1,null,"4a91541a",null);e.default=u.exports},79:function(t,e,n){var o=n(218);"string"==typeof o&&(o=[[t.i,o,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};n(22)(o,r);o.locals&&(t.exports=o.locals)}}]);