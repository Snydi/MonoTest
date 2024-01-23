<template>
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: currentPage === 1 }">
        <button class="page-link" @click="changePage(currentPage - 1)" :disabled="currentPage === 1">
          &laquo;
        </button>
      </li>

      <li v-for="page in pages" :key="page" class="page-item" :class="{ active: page === currentPage }">
        <button class="page-link" @click="changePage(page)">{{ page }}</button>
      </li>

      <li class="page-item" :class="{ disabled: currentPage === totalPages }">
        <button class="page-link" @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages">
          &raquo;
        </button>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  computed: {
    currentPage() {
      return this.data.current_page || 1;
    },
    totalPages() {
      return this.data.last_page || 1;
    },
    pages() {
      return Array.from({ length: this.totalPages }, (_, i) => i + 1);
    },
  },
  methods: {
    changePage(page) {
      this.$emit('page-change', page);
    },
  },
};
</script>

<style>
.pagination {
  display: flex;
  list-style: none;
}

.page-item {
  margin: 0 2px;
}

.page-link {
  cursor: pointer;
  padding: 6px 12px;
  border: 1px solid #ddd;
  color: #333;
  background-color: #fff;

}

.page-item.disabled .page-link,
.page-item.disabled .page-link:hover {
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
  color: #ddd;
}
</style>
