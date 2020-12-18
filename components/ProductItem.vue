<template>
  <div class="my-2 px-2 w-1/2 md:w-1/3 lg:my-4 lg:px-2 lg:w-1/5">
    <!-- Article -->
    <article class="overflow-hidden rounded-lg shadow-lg bg-white">
      <NuxtLink to="/product">
        <div
          class="h-36 lg:h-48 w-full bg-cover"
          :style="{ backgroundImage: 'url(' + product.imgLink + ')' }"
        ></div>

        <header
          class="flex items-center justify-between leading-tight p-2 md:p-4"
        >
          <div class="">
            <p class="mb-2">{{ product.title }}</p>
            <b>RM{{ product.price.toFixed(2) }}</b>
          </div>
        </header>
      </NuxtLink>

      <footer class="flex items-center justify-around leading-none p-2 md:p-4">
        <!-- Heroicon name: heart -->
        <svg
          class="h-5 w-5"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          v-show="!product.wishlist"
          @click="product.wishlist = !product.wishlist"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
          />
        </svg>
        <!-- Heroicon name: heart -->
        <svg
          class="h-5 w-5 text-pink-500"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          v-show="product.wishlist"
          @click="product.wishlist = !product.wishlist"
        >
          <path
            fill-rule="evenodd"
            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
            clip-rule="evenodd"
          />
        </svg>

        <!-- Heroicon name: shopping-cart -->
        <svg
          class="h-5 w-5"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
          />
        </svg>
      </footer>
    </article>
    <!-- END Article -->
  </div>
</template>

<script>
export default {
  data: () => ({
    // wishlist: true,
  }),
  props: ["product"],
};
</script>