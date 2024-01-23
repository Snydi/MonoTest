<template>
  <div>
    <h1>Клиенты</h1>
    <router-link to="/cars">
      <button class="btn btn-success">На парковку</button>
    </router-link>
    <router-link to="/clients/create/">
      <button class="btn btn-success">Добавить</button>
    </router-link>

    <table class="table">
      <thead>
      <tr>
        <th scope="col">Клиент</th>
        <th scope="col">Авто</th>
        <th scope="col">Номер</th>
        <th><button class="btn btn-primary">Редактировать</button></th>
        <th><button class="btn btn-danger">Удалить</button></th>
      </tr>
      </thead>




      <tbody>
      <tr v-for="client in clients.data || []" :key="client.id">
        <td>{{ client.id }}</td>
        <td>{{ client.name }}</td>
        <td>{{ client.brand }}</td>
        <td>{{ client.plate }}</td>
      </tr>

      </tbody>
<!--      <td>-->
<!--        <router-link :to="{ name: 'editClient', params: { id: client.id } }">-->
<!--          <button class="btn btn-primary">Редактировать</button>-->
<!--        </router-link>-->
<!--      </td>-->
<!--        <td>-->
<!--          <button @click="deleteClient(client.id)" class="btn btn-danger">Удалить</button>-->
<!--        </td>-->
<!--      </tr>-->
    </table>

    <div class="d-flex">
      <Pagination :data="clients" @page-change="loadClients" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Pagination from '../components/Pagination.vue';

export default {
  data() {
    return {
      clients: {
        data: [],
        current_page: 1,
        last_page: 1,
      },
      loading: false,
    };
  },
  components: {
    Pagination,
  },
  methods: {
    async loadClients(page = 1) {
      this.loading = true;

      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/clients?page=${page}`);
        this.clients = response.data;
      } catch (error) {
        console.error('Error fetching clients:', error);
      } finally {
        this.loading = false;
      }
    },
  },
  mounted() {
    this.loadClients();
  },
};
</script>
