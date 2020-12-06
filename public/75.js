(window.webpackJsonp=window.webpackJsonp||[]).push([[75],{470:function(o,r,t){"use strict";t.r(r);var e=o=>{if(void 0===o)throw new TypeError("Hex color is not defined");if("transparent"===o)return"#00000000";const r=o.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);if(!r)throw new Error(`${o} is not a valid rgb color`);const t=`0${parseInt(r[1],10).toString(16)}`,e=`0${parseInt(r[2],10).toString(16)}`,l=`0${parseInt(r[3],10).toString(16)}`;return`#${t.slice(-2)}${e.slice(-2)}${l.slice(-2)}`},l={name:"ColorView",data:function(){return{bgColor:"rgb(255, 255, 255)"}},computed:{hexColor:function(){return e(this.bgColor)}},methods:{setColor:function(){var o=this.$parent.$el.children[0],r=window.getComputedStyle(o).getPropertyValue("background-color");this.bgColor=r||this.bgColor}},mounted:function(){this.setColor()}},a=t(0),n={name:"ColorTheme",components:{ColorView:Object(a.a)(l,(function(){var o=this,r=o.$createElement,t=o._self._c||r;return t("table",{staticClass:"w-100"},[t("tbody",[t("tr",[t("td",{staticClass:"text-muted"},[o._v("HEX:")]),o._v(" "),t("td",{staticClass:"font-weight-bold"},[o._v(o._s(this.hexColor))])]),o._v(" "),t("tr",[t("td",{staticClass:"text-muted"},[o._v("RGB:")]),o._v(" "),t("td",{staticClass:"font-weight-bold"},[o._v(o._s(this.bgColor))])])])])}),[],!1,null,null,null).exports},props:{color:String}},s={name:"Colors",components:{ColorTheme:Object(a.a)(n,(function(){var o=this.$createElement,r=this._self._c||o;return r("CCol",{staticClass:"mb-4",attrs:{xl:"2",md:"4",sm:"6",xs:"12"}},[r("div",{class:["theme-color w-75 rounded mb-3",this.color],style:{paddingTop:"75%"}}),this._v(" "),this._t("default"),this._v(" "),r("ColorView")],2)}),[],!1,null,null,null).exports}},C=Object(a.a)(s,(function(){var o=this,r=o.$createElement,t=o._self._c||r;return t("div",[t("CCard",[t("CCardHeader",[t("CIcon",{attrs:{name:"cil-drop"}}),o._v(" Theme colors\n    ")],1),o._v(" "),t("CCardBody",[t("CRow",[t("ColorTheme",{attrs:{color:"bg-primary"}},[t("h6",[o._v("Brand Primary Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-secondary"}},[t("h6",[o._v("Brand Secondary Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-success"}},[t("h6",[o._v("Brand Success Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-danger"}},[t("h6",[o._v("Brand Danger Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-warning"}},[t("h6",[o._v("Brand Warning Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-info"}},[t("h6",[o._v("Brand Info Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-light"}},[t("h6",[o._v("Brand Light Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-dark"}},[t("h6",[o._v("Brand Dark Color")])])],1)],1)],1),o._v(" "),t("CCard",[t("CCardHeader",[t("CIcon",{attrs:{name:"cil-drop"}}),o._v(" Grays\n    ")],1),o._v(" "),t("CCardBody",[t("CRow",[t("ColorTheme",{attrs:{color:"bg-gray-100"}},[t("h6",[o._v("Brand 100 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-200"}},[t("h6",[o._v("Brand 200 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-300"}},[t("h6",[o._v("Brand 300 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-400"}},[t("h6",[o._v("Brand 400 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-500"}},[t("h6",[o._v("Brand 500 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-600"}},[t("h6",[o._v("Brand 600 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-700"}},[t("h6",[o._v("Brand 700 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-800"}},[t("h6",[o._v("Brand 800 Color")])]),o._v(" "),t("ColorTheme",{attrs:{color:"bg-gray-900"}},[t("h6",[o._v("Brand 900 Color")])])],1)],1)],1)],1)}),[],!1,null,null,null);r.default=C.exports}}]);