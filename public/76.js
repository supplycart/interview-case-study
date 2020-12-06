(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[76],{

/***/ "./coreui/src/views/users/Users.vue":
/*!******************************************!*\
  !*** ./coreui/src/views/users/Users.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Users_vue_vue_type_template_id_41714d07___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Users.vue?vue&type=template&id=41714d07& */ "./coreui/src/views/users/Users.vue?vue&type=template&id=41714d07&");
/* harmony import */ var _Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Users.vue?vue&type=script&lang=js& */ "./coreui/src/views/users/Users.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Users_vue_vue_type_template_id_41714d07___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Users_vue_vue_type_template_id_41714d07___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "coreui/src/views/users/Users.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./coreui/src/views/users/Users.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./coreui/src/views/users/Users.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Users.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/users/Users.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./coreui/src/views/users/Users.vue?vue&type=template&id=41714d07&":
/*!*************************************************************************!*\
  !*** ./coreui/src/views/users/Users.vue?vue&type=template&id=41714d07& ***!
  \*************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_template_id_41714d07___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Users.vue?vue&type=template&id=41714d07& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/users/Users.vue?vue&type=template&id=41714d07&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_template_id_41714d07___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_template_id_41714d07___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/users/Users.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./coreui/src/views/users/Users.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./coreui/node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'Users',
  data: function data() {
    return {
      items: [],
      fields: ['id', 'name', 'registered', 'roles', 'status', 'show', 'edit', 'delete'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      you: null,
      message: '',
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false
    };
  },
  paginationProps: {
    align: 'center',
    doubleArrows: false,
    previousButtonHtml: 'prev',
    nextButtonHtml: 'next'
  },
  methods: {
    getBadge: function getBadge(status) {
      return status === 'Active' ? 'success' : status === 'Inactive' ? 'secondary' : status === 'Pending' ? 'warning' : status === 'Banned' ? 'danger' : 'primary';
    },
    userLink: function userLink(id) {
      return "users/".concat(id.toString());
    },
    editLink: function editLink(id) {
      return "users/".concat(id.toString(), "/edit");
    },
    showUser: function showUser(id) {
      var userLink = this.userLink(id);
      this.$router.push({
        path: userLink
      });
    },
    editUser: function editUser(id) {
      var editLink = this.editLink(id);
      this.$router.push({
        path: editLink
      });
    },
    deleteUser: function deleteUser(id) {
      var self = this;
      var userId = id;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post('/api/users/' + id + '?token=' + localStorage.getItem("api_token"), {
        _method: 'DELETE'
      }).then(function (response) {
        self.message = 'Successfully deleted user.';
        self.showAlert();
        self.getUsers();
      })["catch"](function (error) {
        console.log(error);
        self.$router.push({
          path: '/login'
        });
      });
    },
    countDownChanged: function countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert: function showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
    getUsers: function getUsers() {
      var self = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get('/api/users?token=' + localStorage.getItem("api_token")).then(function (response) {
        self.items = response.data.users;
        self.you = response.data.you;
      })["catch"](function (error) {
        console.log(error);
        self.$router.push({
          path: '/login'
        });
      });
    }
  },
  mounted: function mounted() {
    this.getUsers();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/users/Users.vue?vue&type=template&id=41714d07&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./coreui/src/views/users/Users.vue?vue&type=template&id=41714d07& ***!
  \*******************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "CRow",
    [
      _c(
        "CCol",
        { attrs: { col: "12", xl: "8" } },
        [
          _c(
            "transition",
            { attrs: { name: "slide" } },
            [
              _c(
                "CCard",
                [
                  _c("CCardHeader", [_vm._v("\n          Users\n      ")]),
                  _vm._v(" "),
                  _c(
                    "CCardBody",
                    [
                      _c(
                        "CAlert",
                        {
                          attrs: {
                            show: _vm.dismissCountDown,
                            color: "primary",
                            fade: ""
                          },
                          on: {
                            "update:show": function($event) {
                              _vm.dismissCountDown = $event
                            }
                          }
                        },
                        [
                          _vm._v(
                            "\n          (" +
                              _vm._s(_vm.dismissCountDown) +
                              ") " +
                              _vm._s(_vm.message) +
                              "\n        "
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c("CDataTable", {
                        attrs: {
                          hover: "",
                          striped: "",
                          items: _vm.items,
                          fields: _vm.fields,
                          "items-per-page": 5,
                          pagination: ""
                        },
                        scopedSlots: _vm._u([
                          {
                            key: "status",
                            fn: function(ref) {
                              var item = ref.item
                              return [
                                _c(
                                  "td",
                                  [
                                    _c(
                                      "CBadge",
                                      {
                                        attrs: {
                                          color: _vm.getBadge(item.status)
                                        }
                                      },
                                      [_vm._v(_vm._s(item.status))]
                                    )
                                  ],
                                  1
                                )
                              ]
                            }
                          },
                          {
                            key: "show",
                            fn: function(ref) {
                              var item = ref.item
                              return [
                                _c(
                                  "td",
                                  [
                                    _c(
                                      "CButton",
                                      {
                                        attrs: { color: "primary" },
                                        on: {
                                          click: function($event) {
                                            return _vm.showUser(item.id)
                                          }
                                        }
                                      },
                                      [_vm._v("Show")]
                                    )
                                  ],
                                  1
                                )
                              ]
                            }
                          },
                          {
                            key: "edit",
                            fn: function(ref) {
                              var item = ref.item
                              return [
                                _c(
                                  "td",
                                  [
                                    _c(
                                      "CButton",
                                      {
                                        attrs: { color: "primary" },
                                        on: {
                                          click: function($event) {
                                            return _vm.editUser(item.id)
                                          }
                                        }
                                      },
                                      [_vm._v("Edit")]
                                    )
                                  ],
                                  1
                                )
                              ]
                            }
                          },
                          {
                            key: "delete",
                            fn: function(ref) {
                              var item = ref.item
                              return [
                                _c(
                                  "td",
                                  [
                                    _vm.you != item.id
                                      ? _c(
                                          "CButton",
                                          {
                                            attrs: { color: "danger" },
                                            on: {
                                              click: function($event) {
                                                return _vm.deleteUser(item.id)
                                              }
                                            }
                                          },
                                          [_vm._v("Delete")]
                                        )
                                      : _vm._e()
                                  ],
                                  1
                                )
                              ]
                            }
                          }
                        ])
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);