<template>
  <div class="shadow-md container bg-blue-50 h-12 ">
      <div class = "options h-12">
        <i class="fa fa-history fa-2x" aria-hidden="true"></i>
        <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>

<!-- dropdown button ref: https://tailwindcomponents.com/component/pure-css-dropdown-using-focus-within-with-animation -->
        <div class=" relative inline-block text-left dropdown">
          <span class="rounded-md shadow-sm"> 
            <button class="inline-flex justify-center w-full leading-5 transition duration-150 ease-in-out  rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800" 
             type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
              <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
            </button>
          </span>
          <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
            <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
              <div class="px-4 py-3">         
                <p class="text-sm leading-5">Signed in as</p>
                <p class="text-sm font-medium leading-5 text-gray-900 truncate">tom@example.com</p>
              </div>
              <div class="py-1">
                <a href="javascript:void(0)" tabindex="0" class="hover:bg-gray-300 text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >Account settings</a>
                <a href="javascript:void(0)" tabindex="1" class="hover:bg-gray-300 text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >Support</a>
                <span role="menuitem" tabindex="-1" class="flex justify-between w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 cursor-not-allowed opacity-50" aria-disabled="true">New feature (soon)</span>
              </div>
              <div class="py-1">
                <!-- <a href="javascript:void(0)" tabindex="3" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >Sign out</a> -->
                <router-link to="/" tabindex="3" class="hover:bg-gray-300 text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem">Sign Out</router-link>
              </div>
            </div>
          </div>
        </div>

      </div>
  </div>
</template>

<script>

export default {
  name: "TopBar",
}

</script>

<style scoped>
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

/* dropdown button ref: https://tailwindcomponents.com/component/pure-css-dropdown-using-focus-within-with-animation */
.dropdown:focus-within .dropdown-menu {
  opacity:1;
  transform: translate(0) scale(1);
  visibility: visible;
}
</style>