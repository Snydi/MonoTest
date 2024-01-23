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

      <select v-model="client.sex" class="custom-select" required>
        <option value="N/A" disabled selected>Укажите пол:</option>
        <option value="male">Мужчина</option>
        <option value="female">Женщина</option>
        <option value="N/A">Предпочитаю не указывать</option>
      </select>


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

    <div v-if="errors.length > 0" class="alert alert-danger">
      <ul>
        <li v-for="error in errors">{{ error }}</li>
      </ul>
    </div>

    <p :style="{ color: 'green', display: showMessage ? 'block' : 'none' }">{{ message }}</p>

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
      client: {
        name: "",
        sex: "N/A",
        phone: "",
        address: ""
      },
      cars: [],

      message: '',
      showMessage: false,
      errors: [],
      loading: false,
    };
  },
  methods: {
    async updateClient()
    {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/clients/update/${this.clientId}', this.client);

        this.message = response.data.message;
        this.showMessage = true;
        setTimeout(() => {
          this.showMessage = false;
        }, 5000);

      } catch (error) {

        if (error.response) {
          const fields = Object.keys(error.response.data.errors);
          this.errors = fields.map(key => error.response.data.errors[key]) || ["Серверная ошибка"];

        } else if (error.request) {
          this.errors = ["Нет ответа от сервера"];
        } else {
          this.errors = [error.message];
        }
      }
    },

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
