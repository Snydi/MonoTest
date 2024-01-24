<template>
    <form @submit.prevent="getCarsByClient" method="get">
      <select v-model="selectedClientId" class="custom-select" required>
        <option v-for="client in clients" :key="client.id" :value="client.id">{{ client.name }}</option>
      </select>
    </form>

    <table class="table">
      <thead>
      <tr>
        <th scope="col"><div @click="sortFields('brand')">Марка <i class="bi-sort-alpha-up"></i></div></th>
        <th scope="col"><div @click="sortFields('model')">Модель <i class="bi-sort-alpha-up"></i></div></th>
        <th scope="col"><div @click="sortFields('color')">Цвет кузова <i class="bi-sort-alpha-up"></i></div></th>
        <th scope="col"><div @click="sortFields('plate')">Гос номер РФ <i class="bi-sort-alpha-up"></i></div></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="car in cars" :key="car.id">
        <td>{{ car.brand }}</td>
        <td>{{ car.model }}</td>
        <td>{{ car.color }}</td>
        <td>{{ car.plate }}</td>
      </tr>
      </tbody>
    </table>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      selectedClientId: null,
      clients: [],
      cars: [],
    };
  },
  methods: {
    sortFields(field) {
      this.sortCarsState = !this.sortCarsState;

      const compareFunction = (a, b) => {
        const valueA = a[field];
        const valueB = b[field];

        if (valueA === null) return 1;
        if (valueB === null) return -1;

        return this.sortCarsState
            ? valueA.localeCompare(valueB)
            : valueB.localeCompare(valueA);
      };

      this.cars.sort(compareFunction);
    },
    async getCarsByClient() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/cars`);
        this.cars = response.data.cars;
        this.clients = response.data.clients;
        console.log(response.data)
      } catch (error) {
        console.error('Error fetching cars:', error);
      }
    },
  },

  mounted() {
    this.getCarsByClient();
  },
};
</script>

<style>

</style>
