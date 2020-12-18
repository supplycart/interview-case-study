<template>
  <div v-if="this.$store.state.loading" class="loader-wrapper" id="spinner-loading">
    <div class="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
</template>
<script>
export default {
  name: "Loading"
}
</script>

<style lang="scss" scoped>

.loader-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1000;
}
.loader {
  display: block;
  position: relative;
  left: 50%;
  top: 50%;
  width: 120px;
  height: 120px;
  margin: -75px 0 0 -75px;
  border-radius: 50%;
  border: 3px solid transparent;
  border-top-color: #3498db;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  z-index: 1001;
}
.loader:before {
  content: "";
  position: absolute;
  top: 5px;
  left: 5px;
  right: 5px;
  bottom: 5px;
  border-radius: 50%;
  border: 3px solid transparent;
  border-top-color: #e74c3c;
  -webkit-animation: spin 3s linear infinite;
  animation: spin 3s linear infinite;
}
.loader:after {
  content: "";
  position: absolute;
  top: 15px;
  left: 15px;
  right: 15px;
  bottom: 15px;
  border-radius: 50%;
  border: 3px solid transparent;
  border-top-color: #f9c922;
  -webkit-animation: spin 1.5s linear infinite;
  animation: spin 1.5s linear infinite;
}
.loader-wrapper .loader-section.section-left {
  left: 0;
}
.loader-wrapper .loader-section {
  position: fixed;
  top: 0;
  width: 50%;
  height: 100%;
  background: hsla(0, 3%, 80%, .411);
  z-index: 1000;
}
.loader-wrapper .loader-section.section-right {
  right: 0;
}
.loader-wrapper .loader-section {
  position: fixed;
  top: 0;
  width: 50%;
  height: 100%;
  background: hsla(0, 3%, 80%, .411);
  z-index: 1000;
}
@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg); /* Chrome, Opera 15+, Safari 3.1+ */
    -ms-transform: rotate(0deg); /* IE 9 */
    transform: rotate(0deg); /* Firefox 16+, IE 10+, Opera */
  }
  100% {
    -webkit-transform: rotate(360deg); /* Chrome, Opera 15+, Safari 3.1+ */
    -ms-transform: rotate(360deg); /* IE 9 */
    transform: rotate(360deg); /* Firefox 16+, IE 10+, Opera */
  }
}
@keyframes spin {
  0% {
    -webkit-transform: rotate(0deg); /* Chrome, Opera 15+, Safari 3.1+ */
    -ms-transform: rotate(0deg); /* IE 9 */
    transform: rotate(0deg); /* Firefox 16+, IE 10+, Opera */
  }
  100% {
    -webkit-transform: rotate(360deg); /* Chrome, Opera 15+, Safari 3.1+ */
    -ms-transform: rotate(360deg); /* IE 9 */
    transform: rotate(360deg); /* Firefox 16+, IE 10+, Opera */
  }
}
</style>
