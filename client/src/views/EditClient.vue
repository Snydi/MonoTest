<template>
  <div class="container w-25">
    <h1>Клиент</h1>
    <router-link to="/clients/">
      <button type="button" class="btn btn-success">Назад</button>
    </router-link>

    <form @submit.prevent="updateClient" >
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

    <ApiErrorMessage :errors="errors" :showMessage="showApiErrorMessage"/>
    <ApiSuccessMessage :message="message" :showMessage="showApiSuccessMessage" />

    <h1>Машины</h1>

    <div v-for="car in cars" :key="car.id">
      <edit-car-form :car="car"   @carDeleted="removeDeletedCar"/>
    </div>

    <h1>Добавить машину</h1>
    <create-car-form :clientId="this.clientId" @carCreated="addNewCar" ></create-car-form>

  </div>
</template>

<script>
import EditCarForm from '../components/EditCarForm.vue';
import CreateCarForm from "../components/CreateCarForm.vue";
import ApiErrorMessage from "../components/ApiErrorMessage.vue";
import ApiSuccessMessage from "../components/ApiSuccessMessage.vue";
import ApiService from "../services/ApiService.js";
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
      showApiSuccessMessage: false,
      showApiErrorMessage: false,
      errors: [],
    };
  },

  methods: {
    addNewCar() {
      this.getClientAndCarsData();
    },
    removeDeletedCar(deletedCarId) {
      const index = this.cars.findIndex(car => car.id === deletedCarId);
      if (index !== -1) {
        this.cars.splice(index, 1);
      }
    },
    async updateClient() {
        const { success, data, error } = await ApiService.makeRequest(
            `clients/update/${this.clientId}`,
            "post",
            this.client,
            this
        );
        if (success) {
          ApiService.handleSuccessMessage(data.message, this);
        } else {
          ApiService.handleErrorMessage(error, this);
        }
    },


    async getClientAndCarsData() {
      const {data} = await ApiService.makeRequest(
          `clients/edit/${this.clientId}`,
          "get",
          null,
          this
      );
      this.client = data.client;
      this.cars = data.cars;
    },
  },
  components: {
    ApiErrorMessage,
    ApiSuccessMessage,
    CreateCarForm,
    EditCarForm,
  },
  mounted() {
    this.clientId = this.$route.params.id;
    this.getClientAndCarsData();
  },
};
</script>

<style scoped>
.form-inline {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.form-group {
    flex: 0 0 48%; /* Adjust this value as needed */
}
</style>
