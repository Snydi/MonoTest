<template>
  <div>
    <h1>Клиент</h1>
    <router-link to="/clients/">
      <button type="button" class="btn btn-success">Назад</button>
    </router-link>

    <form @submit.prevent="updateClient">
      <div class="form-group">
        <label for="name">ФИО</label>
        <input v-model="client.name" type="text" class="form-control" id="name" placeholder="ФИО:" required />
      </div>

      <div class="form-group">
        <label for="phone">Телефон</label>
        <input v-model="client.phone" type="text" class="form-control" id="phone" placeholder="Телефон:" required />
      </div>

      <div class="form-group">
        <label for="address">Адрес</label>
        <input v-model="client.address" type="text" class="form-control" id="address" placeholder="Адрес:" required />
      </div>


      <button type="submit" class="btn btn-primary">Редактировать</button>
    </form>

    <h1>Машины</h1>

    <div v-for="car in cars" :key="car.id">
<!--      <CarUpdateForm :car="car" @submit="updateCar" />-->
<!--      <CarDeleteForm :car="car" @submit="deleteCar" />-->
    </div>

    <h1>Добавить машину</h1>
<!--    <CarAddForm @submit="addCar" />-->
  </div>
</template>

<script>
import axios from "axios";
// import CarUpdateForm from "@/components/CarUpdateForm.vue";
// import CarDeleteForm from "@/components/CarDeleteForm.vue";
// import CarAddForm from "@/components/CarAddForm.vue";

export default {
  data() {
    return {
      clientId: null,
      client: [],
      cars: [],
      loading: false,
    };
  },
  methods: {
    async getClientAndCarsData() {
      this.loading = true;

      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/clients/edit/${this.clientId}`);
        this.client = response.data.client[0];
        this.cars = response.data.cars;
      } catch (error) {
        console.error('Error fetching clients with cars:', error);
      } finally {
        this.loading = false;
      }
    },
  },
  components: {
    // CarUpdateForm,
    // CarDeleteForm,
    // CarAddForm,
  },
  mounted() {
    this.clientId = this.$route.params.id;
    this.getClientAndCarsData();


  },
};
</script>
