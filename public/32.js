(window.webpackJsonp=window.webpackJsonp||[]).push([[32],{490:function(t,a,c){"use strict";c.r(a);var s={name:"Switches",data:function(){return{colors:["primary","secondary","warning","success","info","danger","light","dark"],fields:[{key:"size"},{key:"example"},{key:"size_prop",label:"Size prop"}],items:[{size:"Large",example:{variant:"3d",color:"primary",size:"lg",checked:!0},size_prop:'Add following prop <code>size="lg"</code>'},{size:"Normal",example:{variant:"3d",color:"primary",size:"",checked:!0},size_prop:"-"},{size:"Small",example:{variant:"3d",color:"primary",size:"sm",checked:!0},size_prop:'Add following prop <code>size="sm"</code>'}],checker:!0,radio:"warning",labelIcon:{labelOn:"✓",labelOff:"✕"},labelTxt:{labelOn:"yes",labelOff:"no"}}}},i=c(0),l=Object(i.a)(s,(function(){var t=this,a=t.$createElement,c=t._self._c||a;return c("div",[c("CRow",[c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Radio switches\n          "),c("CBadge",{staticClass:"mr-auto",attrs:{color:t.radio}},[t._v(t._s(t.radio))]),t._v(" "),c("div",{staticClass:"card-header-actions"},[c("a",{staticClass:"card-header-action",attrs:{href:"https://coreui.io/vue/docs/components/switch",rel:"noreferrer noopener",target:"_blank"}},[c("small",{staticClass:"text-muted"},[t._v("docs")])])])],1),t._v(" "),c("CCardBody",t._l(t.colors,(function(a,s){return c("CSwitch",t._b({key:"radio"+s,staticClass:"mx-1",attrs:{color:a,variant:"3d",type:"radio",name:"radio",checked:2===s,value:a},on:{"update:checked":function(c){return c?t.radio=a:null}}},"CSwitch",t.labelIcon,!1))})),1)],1)],1)],1),t._v(" "),c("CRow",[c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch default\n          "),c("CBadge",{attrs:{color:"primary"}},[t._v(t._s(t.checker))])],1),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",name:"switch1",checked:t.checker},on:{"update:checked":function(a){t.checker=a}}}),t._v(" "),t._l(["secondary","success","warning","info","danger","light","dark"],(function(t,a){return c("CSwitch",{key:a,staticClass:"mx-1",attrs:{color:t,checked:""}})})),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",disabled:""}})],2)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch pills\n        ")]),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"secondary",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"success",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"warning",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"info",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"danger",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"light",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"dark",checked:"",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",disabled:"",shape:"pill"}})],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          3d Switch\n        ")]),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"3d"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",disabled:"",variant:"3d"}})],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          3d Switch "),c("small",[c("code",[t._v("disabled")])])]),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"3d",disabled:""}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",disabled:"",variant:"3d"}})],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          3d Switch "),c("small",[c("code",[t._v("label")])])]),t._v(" "),c("CCardBody",[c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",variant:"3d",shape:"square",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"3d"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"3d"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"3d"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"3d"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"3d"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"3d"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"3d"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",disabled:"",variant:"3d"}},"CSwitch",t.labelIcon,!1))],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('variant="outline"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"outline"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",variant:"outline",disabled:""}})],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('variant="outline"  shape="pill"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"outline",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",variant:"outline",shape:"pill",disabled:""}})],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('variant="opposite"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"opposite"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",variant:"opposite",disabled:""}})],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('variant="opposite"  shape="pill"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"opposite",shape:"pill"}}),t._v(" "),c("CSwitch",{staticClass:"mx-1",attrs:{color:"primary",variant:"opposite",shape:"pill",disabled:""}})],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v("label")])])]),t._v(" "),c("CCardBody",[c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"secondary",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"success",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"warning",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"info",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"danger",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"light",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"dark",checked:""}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",disabled:""}},"CSwitch",t.labelIcon,!1))],1)],1),t._v("shape\n    ")],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('label shape="pill"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"secondary",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"success",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"warning",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"info",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"danger",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"light",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"dark",checked:"",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",shape:"pill",disabled:""}},"CSwitch",t.labelIcon,!1))],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('label variant="outline"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"outline"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",variant:"outline",disabled:""}},"CSwitch",t.labelIcon,!1))],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('label variant="outline"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"outline",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",variant:"outline",shape:"pill",disabled:""}},"CSwitch",t.labelIcon,!1))],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('label variant="opposite"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"opposite"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",variant:"opposite",disabled:""}},"CSwitch",t.labelIcon,!1))],1)],1)],1),t._v(" "),c("CCol",{attrs:{xs:"12",md:"6"}},[c("CCard",[c("CCardHeader",[t._v("\n          Switch "),c("small",[c("code",[t._v('label variant="opposite"')])])]),t._v(" "),c("CCardBody",[c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelTxt,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"secondary",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"success",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"warning",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"info",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"danger",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"light",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"dark",checked:"",variant:"opposite",shape:"pill"}},"CSwitch",t.labelIcon,!1)),t._v(" "),c("CSwitch",t._b({staticClass:"mx-1",attrs:{color:"primary",variant:"opposite",shape:"pill",disabled:""}},"CSwitch",t.labelIcon,!1))],1)],1)],1),t._v(" "),c("CCol",{attrs:{md:"12"}},[c("CCard",[c("CCardHeader",[t._v("\n          Sizes\n        ")]),t._v(" "),c("CCardBody",{staticClass:"p-0"},[c("CDataTable",{staticClass:"table-align-middle mb-0",attrs:{hover:"",striped:"",items:t.items,fields:t.fields,"no-sorting":""},scopedSlots:t._u([{key:"example",fn:function(t){var a=t.item;return[c("td",[c("CSwitch",{attrs:{variant:a.example.variant,color:a.example.color,size:a.example.size,checked:a.example.checked}})],1)]}},{key:"size_prop",fn:function(a){var s=a.item;return[c("td",[c("span",{domProps:{innerHTML:t._s(s.size_prop)}})])]}}])})],1)],1)],1)],1)],1)}),[],!1,null,null,null);a.default=l.exports}}]);