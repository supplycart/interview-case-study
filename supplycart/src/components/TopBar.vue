<template>
  <div class="container bg-blue-200 h-12 ">
      <div class = "options h-12">
        <i class="fa fa-history fa-2x" aria-hidden="true"></i>
        <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
        <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
      </div>
  </div>
</template>

<script>
export default {
    name: "TopBar"
}
</script>

<style>
.container {
    /* display:flex; */
    text-align: right; 
    align-items: center;
    justify-content: space-between;
}

.options {
    display: inline-flex;
    justify-content: space-between;
    align-items: center;
    width: 200px;
    padding-left: 20px;
    padding-right: 20px;
}

@media (min-width: 500px){
  .options {
    background: red;
  }
}
</style>