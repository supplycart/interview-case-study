<template>
  <ul class="flex list-reset border border-grey-light rounded w-auto font-sans">
    <li v-if="pagination.current_page > 1">
      <a class="block hover:text-indigo hover:bg-blue text-blue border-r border-grey-light px-3 py-2"
         href="#"
         @click.prevent="change(pagination.current_page -1)"
      >
        Previous
      </a>
    </li>
    <li v-for="page in pages" :key="page">
      <a :class="[page == pagination.current_page ? 'text-indigo bg-blue border-r border-blue':'hover:text-indigo hover:bg-blue text-blue border-r border-grey-light', 'block px-3 py-2']"
         href="#"
         @click.stop="change(page)"
      >
        {{ page }}
      </a>
    </li>
    <li v-if="pagination.current_page < pagination.last_page">
      <a class="block hover:text-indigo hover:bg-blue text-blue px-3 py-2"
         href="#"
         @click.prevent="change(pagination.current_page + 1)"
      >
        Next
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  name: "pagination",

  props: {
    pagination: {
      type: Object,
      required: true
    },
    offset: {
      type: Number,
      default: 4
    }
  },

  computed: {
    pages() {
      if (!this.pagination.to) {
        return null;
      }

      let from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      let to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      let pages = [];
      for (let page = from; page <= to; page++) {
        pages.push(page);
      }

      return pages;
    },
  },

  methods: {
    change: function (page) {
      this.pagination.current_page = page;
      this.$emit('paginate');
    }
  }
}
</script>