<template>
  <div>

    <div class="container mx-auto h-screen text-gray-800 flex flex-wrap">

      <div class="w-full lg:w-3/12 flex-0 p-5">
        <div>
          Filter by category
          <table>
            <tr>
              <th>
                <label class="inline-flex items-center mt-3">
                  <input
                      v-model="selectAllCategory" type="checkbox"
                      class="form-checkbox h-5 w-5 text-indigo-600"
                      value="1">
                  <span class="ml-2 text-gray-700">
                   Select All
                 </span>
                </label>
              </th>
            </tr>
            <tr v-for="category in categories">
              <td>
                <label class="inline-flex items-center mt-3">
                  <input name="category[]"
                         v-model="selectedCategory"
                         type="checkbox"
                         class="form-checkbox h-5 w-5 text-indigo-600"
                         :value="category.id">
                  <span class="ml-2 text-gray-700">
                   {{ category.name }}
                 </span>
                </label>
              </td>
            </tr>
          </table>
        </div>
        <br>
        <div>
          Filter by brand
          <table>
            <tr>
              <th>

                <label class="inline-flex items-center mt-3">
                  <input
                      v-model="selectAllBrand" type="checkbox"
                      class="form-checkbox h-5 w-5 text-indigo-600"
                      value="1">
                  <span class="ml-2 text-gray-700">
                   Select All
                 </span>
                </label>
              </th>
            </tr>
            <tr v-for="category in brands">
              <td>
                <label class="inline-flex items-center mt-3">
                  <input name="brand[]"
                         v-model="selectedBrand"
                         type="checkbox"
                         class="form-checkbox h-5 w-5 text-indigo-600"
                         :value="category.id">
                  <span class="ml-2 text-gray-700">
                   {{ category.name }}
                 </span>
                </label>
              </td>
            </tr>
          </table>
        </div>

        <v-button @click.native="filterProducts">
          Filter Product
        </v-button>

      </div>
      <div class="w-full lg:w-9/12 flex-0 p-5 bg-white shadow-lg rounded-b-lg">
        Products
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div v-for="product in products" :key="product.id">
            <div class="container mx-auto max-w-sm w-full p-4 ">
              <div class="card flex flex-col justify-center p-10 bg-white rounded-lg shadow-2xl">
                <div class="prod-title">
                  <p class="text-2xl uppercase text-gray-900 font-bold">{{ product.name }}</p>
                  <p class="uppercase text-sm text-gray-400">
                    {{ product.description }}
                  </p>
                </div>
                <div class="prod-img">
                  <img :src="product.image"
                       class="w-full object-cover object-center"/>
                </div>
                <div class="prod-info grid gap-10">
                  <div>
                    Category: {{ product.category.name }}<br>
                    Brand: {{ product.brand.name }}
                  </div>
                  <div class="flex flex-col md:flex-row justify-between items-center text-gray-900">
                    <p class="font-bold text-xl">$ {{ product.price }}</p>
                    <button v-if="carts?carts.map(o => o['product_id']).includes(product.id):false">
                      Added
                    </button>
                    <button v-else @click="addToCart(product.id)"
                            class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">
                      Add to cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <pagination :pagination="pagination" @paginate="fetchProducts" :offset="4"/>
      </div>


    </div>

  </div>
</template>

<script>
import Pagination from "../components/Pagination";
import axios from "axios";
import {mapGetters} from "vuex";

export default {
  components: {pagination: Pagination},

  middleware: 'auth',

  metaInfo() {
    return {title: "Home"}
  },
  data() {

    return {

      products: [],
      offset: 4,
      pagination: {},
      categories: [],
      brands: [],
      selectedCategory: [],
      selectedBrand: [],
      filter: {
        cat_ids: [],
      },
    }
  },

  computed: {
    ...mapGetters({
      carts: 'carts/carts',
    }),
    selectAllCategory: {
      get: function () {
        return this.categories ? this.selectedCategory.length == this.categories.length : false;
      },
      set: function (value) {
        var selectedCategory = [];

        if (value) {
          this.categories.forEach(function (category) {
            selectedCategory.push(category.id);
          });
        }

        this.selectedCategory = selectedCategory;
      }
    },
    selectAllBrand: {
      get: function () {
        return this.brands ? this.selectedBrand.length == this.brands.length : false;
      },
      set: function (value) {
        var selectedBrand = [];

        if (value) {
          this.brands.forEach(function (category) {
            selectedBrand.push(category.id);
          });
        }

        this.selectedBrand = selectedBrand;
      }
    },
  },

  async created() {
    this.fetchProducts();
    await this.$store.dispatch('products/fetchCategories');
    await this.$store.dispatch('products/fetchBrands');
    await this.$store.dispatch('carts/fetchCarts');
    this.categories = this.$store.getters['products/categories']
    this.brands = this.$store.getters['products/brands']
    // this.carts = this.$store.getters['carts/carts']
  },
  methods: {
    select: function () {
    },
    filterProducts: function () {
      this.filter.cat_ids = this.selectedCategory;
      this.filter.brand_ids = this.selectedBrand;
      this.fetchProducts();
    },
    fetchProducts: function () {
      let current_page = this.pagination.current_page;
      let page_number = current_page ? current_page : 1;
      let filter = this.serialize(this.filter);
      axios.get('/api/products?page=' + page_number + '&' + filter).then(response => {
        console.log('ok', response)
        this.pagination = response.data.pagination;
        this.products = response.data.products;
      })
          .catch(error => console.log(error))
    },
    serialize: function (obj, prefix) {
      var str = [],
          p;
      for (p in obj) {
        if (obj.hasOwnProperty(p)) {
          var k = prefix ? prefix + "[" + p + "]" : p,
              v = obj[p];
          str.push((v !== null && typeof v === "object") ?
              this.serialize(v, k) :
              k + "=" + encodeURIComponent(v));
        }
      }
      return str.join("&");
    },
    addToCart: async function (product_id) {
      await this.$store.dispatch('carts/addCart', product_id);
      // this.carts = this.$store.getters['carts/carts']
      return product_id;
    }
  }
}
</script>
