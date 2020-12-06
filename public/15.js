(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{37:function(t,r,e){"use strict";e.r(r);var a=e(14),o=e(464),n=e(465);function i(t,r){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);r&&(a=a.filter((function(r){return Object.getOwnPropertyDescriptor(t,r).enumerable}))),e.push.apply(e,a)}return e}function s(t,r,e){return r in t?Object.defineProperty(t,r,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[r]=e,t}var l={name:"CChartLineSimple",components:{CChartLine:a.CChartLine},props:function(t){for(var r=1;r<arguments.length;r++){var e=null!=arguments[r]?arguments[r]:{};r%2?i(e,!0).forEach((function(r){s(t,r,e[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):i(e).forEach((function(r){Object.defineProperty(t,r,Object.getOwnPropertyDescriptor(e,r))}))}return t}({},a.CChartLine.props,{borderColor:{type:String,default:"rgba(255,255,255,.55)"},backgroundColor:{type:String,default:"transparent"},dataPoints:{type:Array,default:function(){return[10,22,34,46,58,70,46,23,45,78,34,12]}},label:{type:String,default:"Sales"},pointed:Boolean,pointHoverBackgroundColor:String}),computed:{pointHoverColor:function(){return this.pointHoverBackgroundColor?this.pointHoverBackgroundColor:"transparent"!==this.backgroundColor?this.backgroundColor:this.borderColor},defaultDatasets:function(){return[{data:this.dataPoints,borderColor:Object(o.a)(this.borderColor),backgroundColor:Object(o.a)(this.backgroundColor),pointBackgroundColor:Object(o.a)(this.pointHoverColor),pointHoverBackgroundColor:Object(o.a)(this.pointHoverColor),label:this.label}]},pointedOptions:function(){return{scales:{xAxes:[{offset:!0,gridLines:{color:"transparent",zeroLineColor:"transparent"},ticks:{fontSize:2,fontColor:"transparent"}}],yAxes:[{display:!1,ticks:{display:!1,min:Math.min.apply(Math,this.dataPoints)-5,max:Math.max.apply(Math,this.dataPoints)+5}}]},elements:{line:{borderWidth:1},point:{radius:4,hitRadius:10,hoverRadius:4}}}},straightOptions:function(){return{scales:{xAxes:[{display:!1}],yAxes:[{display:!1}]},elements:{line:{borderWidth:2},point:{radius:0,hitRadius:10,hoverRadius:4}}}},defaultOptions:function(){var t=this.pointed?this.pointedOptions:this.straightOptions;return Object.assign({},t,{maintainAspectRatio:!1,legend:{display:!1}})},computedDatasets:function(){return Object(n.a)(this.defaultDatasets,this.datasets||{})},computedOptions:function(){return Object(n.a)(this.defaultOptions,this.options||{})}}},u=e(0),c=Object(u.a)(l,(function(){var t=this.$createElement;return(this._self._c||t)("CChartLine",{attrs:{datasets:this.computedDatasets,options:this.computedOptions,labels:this.labels}})}),[],!1,null,null,null).exports;function d(t,r){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);r&&(a=a.filter((function(r){return Object.getOwnPropertyDescriptor(t,r).enumerable}))),e.push.apply(e,a)}return e}function C(t,r,e){return r in t?Object.defineProperty(t,r,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[r]=e,t}var p={name:"CChartBarSimple",components:{CChartBar:a.CChartBar},props:function(t){for(var r=1;r<arguments.length;r++){var e=null!=arguments[r]?arguments[r]:{};r%2?d(e,!0).forEach((function(r){C(t,r,e[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):d(e).forEach((function(r){Object.defineProperty(t,r,Object.getOwnPropertyDescriptor(e,r))}))}return t}({},a.CChartBar.props,{backgroundColor:{type:String,default:"rgba(0,0,0,.2)"},pointHoverBackgroundColor:String,dataPoints:{type:Array,default:function(){return[10,22,34,46,58,70,46,23,45,78,34,12]}},label:{type:String,default:"Sales"},pointed:Boolean}),computed:{defaultDatasets:function(){return[{data:this.dataPoints,backgroundColor:Object(o.a)(this.backgroundColor),pointHoverBackgroundColor:Object(o.a)(this.pointHoverBackgroundColor),label:this.label,barPercentage:.5,categoryPercentage:1}]},defaultOptions:function(){return{maintainAspectRatio:!1,legend:{display:!1},scales:{xAxes:[{display:!1}],yAxes:[{display:!1}]}}},computedDatasets:function(){return Object(n.a)(this.defaultDatasets,this.datasets||{})},computedOptions:function(){return Object(n.a)(this.defaultOptions,this.options||{})}}},h=Object(u.a)(p,(function(){var t=this.$createElement;return(this._self._c||t)("CChartBar",{attrs:{datasets:this.computedDatasets,options:this.computedOptions,labels:this.labels}})}),[],!1,null,null,null).exports,b={name:"CChartLineExample",components:{CChartLine:a.CChartLine},computed:{defaultDatasets:function(){return[{label:"Data One",backgroundColor:"rgb(228,102,81,0.9)",data:[30,39,10,50,30,70,35]},{label:"Data Two",backgroundColor:"rgb(0,216,255,0.9)",data:[39,80,40,35,40,20,45]}]}}},f=Object(u.a)(b,(function(){var t=this.$createElement;return(this._self._c||t)("CChartLine",{attrs:{datasets:this.defaultDatasets,labels:"months"}})}),[],!1,null,null,null).exports,g={name:"CChartBarExample",components:{CChartBar:a.CChartBar},computed:{defaultDatasets:function(){return[{label:"GitHub Commits",backgroundColor:"#f87979",data:[40,20,12,39,10,40,39,80,40,20,12,11]}]}}},m=Object(u.a)(g,(function(){var t=this.$createElement;return(this._self._c||t)("CChartBar",{attrs:{datasets:this.defaultDatasets,labels:"months"}})}),[],!1,null,null,null).exports,O={name:"CChartDoughnutExample",components:{CChartDoughnut:a.CChartDoughnut},computed:{defaultDatasets:function(){return[{backgroundColor:["#41B883","#E46651","#00D8FF","#DD1B16"],data:[40,20,80,10]}]}}},v=Object(u.a)(O,(function(){var t=this.$createElement;return(this._self._c||t)("CChartDoughnut",{attrs:{datasets:this.defaultDatasets,labels:["VueJs","EmberJs","ReactJs","AngularJs"]}})}),[],!1,null,null,null).exports,y={name:"CChartRadarExample",components:{CChartRadar:a.CChartRadar},computed:{defaultDatasets:function(){return[{label:"2019",backgroundColor:"rgba(179,181,198,0.2)",borderColor:"rgba(179,181,198,1)",pointBackgroundColor:"rgba(179,181,198,1)",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"rgba(179,181,198,1)",tooltipLabelColor:"rgba(179,181,198,1)",data:[65,59,90,81,56,55,40]},{label:"2020",backgroundColor:"rgba(255,99,132,0.2)",borderColor:"rgba(255,99,132,1)",pointBackgroundColor:"rgba(255,99,132,1)",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"rgba(255,99,132,1)",tooltipLabelColor:"rgba(255,99,132,1)",data:[28,48,40,19,96,27,100]}]},defaultOptions:function(){return{aspectRatio:1.5}}}},B=Object(u.a)(y,(function(){var t=this.$createElement;return(this._self._c||t)("CChartRadar",{attrs:{datasets:this.defaultDatasets,options:this.defaultOptions,labels:["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"]}})}),[],!1,null,null,null).exports,D={name:"CChartPieExample",components:{CChartPie:a.CChartPie},computed:{defaultDatasets:function(){return[{backgroundColor:["#41B883","#E46651","#00D8FF","#DD1B16"],data:[40,20,80,10]}]}}},j=Object(u.a)(D,(function(){var t=this.$createElement;return(this._self._c||t)("CChartPie",{attrs:{datasets:this.defaultDatasets,labels:["VueJs","EmberJs","ReactJs","AngularJs"]}})}),[],!1,null,null,null).exports,P={name:"CChartPolarAreaExample",components:{CChartPolarArea:a.CChartPolarArea},computed:{defaultDatasets:function(){return[{label:"My First dataset",backgroundColor:"rgba(179,181,198,0.2)",pointBackgroundColor:"rgba(179,181,198,1)",pointBorderColor:"#fff",pointHoverBackgroundColor:"rgba(179,181,198,1)",pointHoverBorderColor:"rgba(179,181,198,1)",data:[65,59,90,81,56,55,40]},{label:"My Second dataset",backgroundColor:"rgba(255,99,132,0.2)",pointBackgroundColor:"rgba(255,99,132,1)",pointBorderColor:"#fff",pointHoverBackgroundColor:"rgba(255,99,132,1)",pointHoverBorderColor:"rgba(255,99,132,1)",data:[28,48,40,19,96,27,100]}]},defaultOptions:function(){return{aspectRatio:1.5}}}},_=Object(u.a)(P,(function(){var t=this.$createElement;return(this._self._c||t)("CChartPolarArea",{attrs:{datasets:this.defaultDatasets,options:this.defaultOptions,labels:["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"]}})}),[],!1,null,null,null).exports;e.d(r,"CChartLineSimple",(function(){return c})),e.d(r,"CChartBarSimple",(function(){return h})),e.d(r,"CChartLineExample",(function(){return f})),e.d(r,"CChartBarExample",(function(){return m})),e.d(r,"CChartDoughnutExample",(function(){return v})),e.d(r,"CChartRadarExample",(function(){return B})),e.d(r,"CChartPieExample",(function(){return j})),e.d(r,"CChartPolarAreaExample",(function(){return _}))},480:function(t,r,e){"use strict";e.r(r);function a(t,r){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);r&&(a=a.filter((function(r){return Object.getOwnPropertyDescriptor(t,r).enumerable}))),e.push.apply(e,a)}return e}function o(t,r,e){return r in t?Object.defineProperty(t,r,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[r]=e,t}var n={name:"Charts",components:function(t){for(var r=1;r<arguments.length;r++){var e=null!=arguments[r]?arguments[r]:{};r%2?a(e,!0).forEach((function(r){o(t,r,e[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):a(e).forEach((function(r){Object.defineProperty(t,r,Object.getOwnPropertyDescriptor(e,r))}))}return t}({},e(37))},i=e(0),s=Object(i.a)(n,(function(){var t=this,r=t.$createElement,e=t._self._c||r;return e("div",[e("CCardGroup",{staticClass:"card-columns cols-2",attrs:{columns:""}},[e("CCard",[e("CCardHeader",[t._v("\n        Line Chart\n        "),e("div",{staticClass:"card-header-actions"},[e("a",{staticClass:"card-header-action",attrs:{href:"https://coreui.io/vue/docs/components/charts",rel:"noreferrer noopener",target:"_blank"}},[e("small",{staticClass:"text-muted"},[t._v("docs")])])])]),t._v(" "),e("CCardBody",[e("CChartLineExample")],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Bar Chart")]),t._v(" "),e("CCardBody",[e("CChartBarExample")],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Doughnut Chart")]),t._v(" "),e("CCardBody",[e("CChartDoughnutExample")],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Radar Chart")]),t._v(" "),e("CCardBody",[e("CChartRadarExample")],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Pie Chart")]),t._v(" "),e("CCardBody",[e("CChartPieExample")],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Polar Area Chart")]),t._v(" "),e("CCardBody",[e("CChartPolarAreaExample")],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Simple line chart")]),t._v(" "),e("CCardBody",[e("CChartLineSimple",{attrs:{"border-color":"success",labels:"months"}})],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Simple pointed chart")]),t._v(" "),e("CCardBody",[e("CChartLineSimple",{attrs:{pointed:"","border-color":"warning"}})],1)],1),t._v(" "),e("CCard",[e("CCardHeader",[t._v("Simple bar chart")]),t._v(" "),e("CCardBody",[e("CChartBarSimple",{attrs:{"background-color":"danger"}})],1)],1)],1)],1)}),[],!1,null,null,null);r.default=s.exports}}]);