<template>
  <div class="wrapper">
    <h1>Клиенты</h1>

    <router-link to="/cars">
      <button class="btn btn-success">На парковку</button>
    </router-link>
    <router-link to="/clients/create/">
      <button class="btn btn-success">Добавить</button>
    </router-link>
    <logout></logout>
    <div class="input-group input-group-sm mb-3">
      <input type="text" v-model="search" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
    </div>
    <table class="table">
      <thead>
      <tr>
        <th scope="col"><div @click="sortFields('name')">Клиент <i class="bi-sort-alpha-up"></i></div></th>
        <th scope="col"><div @click="sortFields('brand')">Марка машины <i class="bi-sort-alpha-up"></i></div></th>
        <th scope="col"><div @click="sortFields('plate')">Номер машины <i class="bi-sort-alpha-up"></i></div></th>
        <th><button class="btn btn-primary">Редактировать</button></th>
        <th><button class="btn btn-danger">Удалить</button></th>
      </tr>
      </thead>

      <tbody>

      <tr v-for="client in searchedClients || []" :key="clients.data">

        <td>{{ client.name }}</td>
        <td>{{ client.brand }}</td>
        <td>{{ client.plate }}</td>

        <td>
          <router-link :to="{ name: 'editClient', params: { id: client.id } }">
            <button class="btn btn-primary">Редактировать</button>
          </router-link>
        </td>

        <td>
          <button @click="deleteClient(client.id)" class="btn btn-danger">Удалить</button>
        </td>

      </tr>
      </tbody>
    </table>

    <div class="d-flex">
      <Pagination :data="clients" @page-change="loadClients" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Pagination from '../components/Pagination.vue';
import Logout from "../components/Logout.vue";
export default {
  data() {
    return {
      sortClientsState: false,
      search: "",
      clients: {
        data: [],
        current_page: 1,
        last_page: 1,
      },

    };
  },
  computed: {
    searchedClients() {
      return this.clients.data.filter(c => {
        return c.name.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
      });
    }
  },
  methods: {
    sortFields(field) {
      this.sortClientsState = !this.sortClientsState;

      const compareFunction = (a, b) => {
        const valueA = a[field];
        const valueB = b[field];

        if (valueA === null) return 1;
        if (valueB === null) return -1;

        return this.sortClientsState
            ? valueA.localeCompare(valueB)
            : valueB.localeCompare(valueA);
      };

      this.clients.data.sort(compareFunction);
    },
    async loadClients(page = 1) {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/clients?page=${page}`);
        this.clients = response.data;
      } catch (error) {
        console.error('Error fetching clients:', error);
      }
    },

  async deleteClient(clientId) {
    if (confirm('Вы уверены, что хотите удалить клиента?')) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/clients/delete/${clientId}`);
        this.clients.last_page = 9;
        await this.loadClients(this.clients.current_page);
      } catch (error) {
        console.error('Error deleting client:', error);
      }
    }
  },
  },
  mounted() {
    this.loadClients();
  },
  components: {
    Pagination,
    Logout,
  },
};
</script>
<style scoped>
.wrapper
{
  width: 600px;
  height: 1080px;
  margin: 0;
}
</style>