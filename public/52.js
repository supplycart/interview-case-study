(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[52],{

/***/ "./coreui/src/views/menu/EditMenu.vue":
/*!********************************************!*\
  !*** ./coreui/src/views/menu/EditMenu.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _EditMenu_vue_vue_type_template_id_4f3f97bf___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EditMenu.vue?vue&type=template&id=4f3f97bf& */ "./coreui/src/views/menu/EditMenu.vue?vue&type=template&id=4f3f97bf&");
/* harmony import */ var _EditMenu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EditMenu.vue?vue&type=script&lang=js& */ "./coreui/src/views/menu/EditMenu.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _EditMenu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _EditMenu_vue_vue_type_template_id_4f3f97bf___WEBPACK_IMPORTED_MODULE_0__["render"],
  _EditMenu_vue_vue_type_template_id_4f3f97bf___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "coreui/src/views/menu/EditMenu.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./coreui/src/views/menu/EditMenu.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./coreui/src/views/menu/EditMenu.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EditMenu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./EditMenu.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/menu/EditMenu.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EditMenu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./coreui/src/views/menu/EditMenu.vue?vue&type=template&id=4f3f97bf&":
/*!***************************************************************************!*\
  !*** ./coreui/src/views/menu/EditMenu.vue?vue&type=template&id=4f3f97bf& ***!
  \***************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditMenu_vue_vue_type_template_id_4f3f97bf___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./EditMenu.vue?vue&type=template&id=4f3f97bf& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/menu/EditMenu.vue?vue&type=template&id=4f3f97bf&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditMenu_vue_vue_type_template_id_4f3f97bf___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditMenu_vue_vue_type_template_id_4f3f97bf___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/menu/EditMenu.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./coreui/src/views/menu/EditMenu.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'EditMenu',
  data: function data() {
    return {
      name: '',
      message: '',
      dismissSecs: 7,
      dismissCountDown: 0
    };
  },
  methods: {
    goBack: function goBack() {
      this.$router.go(-1);
    },
    update: function update() {
      var self = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post('/api/menu/menu/update' + '?token=' + localStorage.getItem("api_token"), {
        name: self.name,
        id: self.$route.params.id
      }).then(function (response) {
        self.message = 'Successfully updated note.';
        self.showAlert();
      })["catch"](function (error) {
        if (error.response.data.message == 'The given data was invalid.') {
          self.message = '';

          for (var key in error.response.data.errors) {
            if (error.response.data.errors.hasOwnProperty(key)) {
              self.message += error.response.data.errors[key][0] + '  ';
            }
          }

          self.showAlert();
        } else {
          console.log(error);
          self.$router.push({
            path: '/login'
          });
        }
      });
    },
    showAlert: function showAlert() {
      this.dismissCountDown = this.dismissSecs;
    }
  },
  mounted: function mounted() {
    var self = this;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get('/api/menu/menu/edit?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id).then(function (response) {
      self.name = response.data.menulist.name;
    })["catch"](function (error) {
      console.log(error);
      self.$router.push({
        path: '/login'
      });
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./coreui/src/views/menu/EditMenu.vue?vue&type=template&id=4f3f97bf&":
/*!*********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./coreui/src/views/menu/EditMenu.vue?vue&type=template&id=4f3f97bf& ***!
  \*********************************************************************************************************************************************************************************************************/
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
        { attrs: { col: "12", lg: "6" } },
        [
          _c(
            "CCard",
            [
              _c(
                "CCardBody",
                [
                  _c("h3", [_vm._v("\n          Edit Menu\n        ")]),
                  _vm._v(" "),
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
                  _c("CInput", {
                    attrs: { label: "Name", type: "text", placeholder: "Name" },
                    model: {
                      value: _vm.name,
                      callback: function($$v) {
                        _vm.name = $$v
                      },
                      expression: "name"
                    }
                  }),
                  _vm._v(" "),
                  _c(
                    "CButton",
                    {
                      attrs: { color: "primary" },
                      on: {
                        click: function($event) {
                          return _vm.update()
                        }
                      }
                    },
                    [_vm._v("Save")]
                  ),
                  _vm._v(" "),
                  _c(
                    "CButton",
                    { attrs: { color: "primary" }, on: { click: _vm.goBack } },
                    [_vm._v("Back")]
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