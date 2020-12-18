<template>
  <div :class="{ dark: isDark }">
    <div class="bg-gray-200 dark:bg-gray-900 pb-2">
      <NavBar :isDark="isDark" />

      <main>
        <!-- <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8"> -->
        <div>
          <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
              <!-- <ProductItem
                v-for="product in products"
                :key="product.id"
                :product="product"
              /> -->
            </div>
            <div
              class="grid gap-3 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-6"
            >
              <ProductItemTwo
                v-for="product in products"
                :key="product.id"
                :product="product"
              />
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import ProductItem from "@/components/ProductItem";
import ProductItemTwo from "@/components/ProductItemTwo";

export default {
  data: () => ({
    products: [
      {
        title: "HDD 2TB",
        imgLink:
          "https://cdn.shopify.com/s/files/1/1974/9033/products/2_3b4c0257-3347-4f13-92b6-0eda17dd0a40_1024x1024.jpg",
        price: 108.0,
        wishlist: false,
        brand: "Seagate",
        category: "storage",
      },
      {
        title: "SSD 256GB",
        imgLink:
          "https://www.italiacom.info/ps/img/p/1/4/9/149-large_default.jpg",
        price: 118.0,
        wishlist: true,
        brand: "Kingston",
        category: "storage",
      },
      {
        title: "2.5 to 3.5 Bracket",
        imgLink:
          "https://cf.shopee.com.my/file/c05a403dedb5df02d271854a278ae857",
        price: 19.0,
        wishlist: false,
        brand: null,
        category: "adapter",
      },
      {
        title: "Ryzen 9 3900X",
        imgLink: "https://c1.neweggimages.com/ProductImage/19-113-103-V07.jpg",
        price: 215.0,
        wishlist: false,
        brand: "AMD",
        category: "CPU",
      },
      {
        title: "ASUS RTX 3070",
        imgLink:
          "https://dlcdnwebimgs.asus.com/gain/7d5094b7-9df5-4ad2-b5b3-6e38ca3ba21d/",
        price: 2698.0,
        wishlist: false,
        brand: "NVidia GeForce",
        category: "GPU",
      },
      {
        title: "Energizer Energy E241S (4G)",
        imgLink:
          "https://cf.shopee.com.my/file/173dd3dbebaf3e0a39b91a47ca2e1d17",
        price: 199.0,
        wishlist: false,
        brand: "Energizer",
        category: "Phone",
      },
      {
        title: "ROG Strix X570-E Gaming ATX",
        imgLink:
          "https://images-na.ssl-images-amazon.com/images/I/61LJV4NBHvL._AC_SX679_.jpg",
        price: 2039.0,
        wishlist: false,
        brand: "Asus",
        category: "motherboard",
      },
      {
        title: "Corsair RMx Series RM850x",
        imgLink:
          "https://cf.shopee.com.my/file/6b17204f0f58da4f0c990ae8db95c851",
        price: 30.0,
        wishlist: false,
        brand: "Corsair",
        category: "power supply",
      },
      {
        title: "WH-1000XM4 Wireless Noise Cancelling",
        imgLink:
          "https://www.sony.com.my/image/5d02da5df552836db894cead8a68f5f3",
        price: 1299.0,
        wishlist: false,
        brand: "Sony",
        category: "headphone",
      },
      {
        title: "PS5 PlayStation 5",
        imgLink:
          "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-LKeg-nUxA-HzxwFtOFKm1GjRrmLRWuo0DQ&usqp=CAU",
        price: 2299.0,
        wishlist: false,
        brand: "Sony",
        category: "console",
      },
      {
        title: "Nintendo Switch",
        imgLink:
          "https://assets1.ignimgs.com/2017/01/20/nintendo-switch-button-2-1484875049952.jpg",
        price: 1699.0,
        wishlist: false,
        brand: "Nintendo",
        category: "console",
      },
      {
        title: "Nintendo Switch Lite",
        imgLink:
          "https://cf.shopee.com.my/file/da4ba5489d1d70f7dc7a8db1036c44d1",
        price: 995.0,
        wishlist: false,
        brand: "Nintendo",
        category: "console",
      },
    ],
    isDark: true,
  }),
  components: {
    NavBar,
  },
};
</script>

<style>
</style>
