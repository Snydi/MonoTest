
<template>
  <button @click="logout" class="btn btn-danger">Разлогиниться</button>
</template>

<script>
import ApiService from '../services/ApiService.js';

export default {
  methods: {
    logout() {
      ApiService.setAuthToken(null);
      this.$router.push({ name: 'login' });
    },
  },
};
</script>
