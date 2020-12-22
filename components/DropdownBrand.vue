<template >
  <div class="relative inline-block text-left w-full md:w-1/2 pr-2">
    <div>
      <button
        type="button"
        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500 dark:text-white dark:bg-gray-800"
        id="options-menu"
        aria-haspopup="true"
        aria-expanded="true"
        @click="dropdownOpen = !dropdownOpen"
        v-click-outside="hideDropdown"
      >
        {{ brand ? brand : "Brand" }}
        <!-- Heroicon name: chevron-down -->
        <svg
          class="-mr-1 ml-2 h-5 w-5"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          aria-hidden="true"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          />
        </svg>
      </button>
    </div>

    <transition
      enter-active-class="transition ease-out duration-100 transform"
      enter-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75 transform"
      leave-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div
        v-show="dropdownOpen"
        class="z-10 origin-top-right absolute left-0 mt-2 w-full rounded-md shadow-lg text-gray-700 bg-white dark:text-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
      >
        <div
          class="py-1"
          role="menu"
          aria-orientation="vertical"
          aria-labelledby="options-menu"
        >
          <span
            class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('')"
          >
            Unselect
          </span>
          <span
            class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('Sony')"
          >
            Sony
          </span>
          <span
            class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('Nintendo')"
          >
            Nintendo
          </span>
          <span
            class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('AMD')"
          >
            AMD
          </span>
          <span
            class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('Seagate')"
          >
            Seagate
          </span>
          <span
            class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('Kingston')"
          >
            Kingston
          </span>
          <span
            class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('Energizer')"
          >
            Energizer
          </span>
          <span
            class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
            role="menuitem"
            @click="changeBrand('Asus')"
          >
            Asus
          </span>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
import ClickOutside from "vue-click-outside";

export default {
  data: () => ({
    dropdownOpen: false,
  }),
  props: ["brand"],
  methods: {
    hideDropdown() {
      this.dropdownOpen = false;
    },
    changeBrand(brand) {
      console.log(brand);
      this.hideDropdown();
      this.$parent.brand = brand;
    },
  },
  mounted() {
    // prevent click outside event with popupItem.
    this.popupItem = this.$el;
  },
  // do not forget this section
  // to close opened menu when click outside of menu
  directives: {
    ClickOutside,
  },
};
</script>
<style>
</style>