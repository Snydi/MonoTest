<template>
  <form @submit.prevent="updateCar">

    <div class="form-group">
      <label for="brand">Марка</label>
      <input v-model="car.brand" type="text" class="form-control" id="brand" placeholder="Марка:" required />
    </div>

    <div class="form-group">
      <label for="model">Модель</label>
      <input v-model="car.model" type="text" class="form-control" id="model" placeholder="Модель:" required />
    </div>

    <div class="form-group">
      <label for="color">Цвет</label>
      <input v-model="car.color" type="text" class="form-control" id="color" placeholder="Цвет:" required />
    </div>

    <div class="form-group">
      <label for="plate">Гос номер РФ</label>
      <input v-model="car.plate" type="text" class="form-control" id="plate" placeholder="Гос номер РФ:" required />
    </div>

    <div class="form-group">
      <label for="park-yes">На парковке</label>
      <input type="radio" id="park-yes" name="in_parking" value="1" v-model="car.in_parking" required />

      <label for="park-no">Отсутствует</label>
      <input type="radio" id="park-no" name="in_parking" value="0" v-model="car.in_parking" required />
    </div>

    <button type="submit" class="btn btn-primary">Редактировать</button>
    <td>
      <button @click="deleteCar(car.id)" class="btn btn-danger">Удалить</button>
    </td>

  </form>

  <div v-if="errors.length > 0" class="alert alert-danger">
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </div>

  <p :style="{ color: 'green', display: showMessage ? 'block' : 'none' }">{{ message }}</p>

</template>

<script>
import axios from 'axios';

export default {
  props: {
    car: Object,
  },
  data() {
    return {
      carData: { ...this.car },
      message: '',
      showMessage: false,
      errors: []
    };
  },
  methods: {
    async updateCar() {
      console.log(this.car)
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/cars/update/${this.carData.clientId}', this.car);

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
    async deleteCar() {
      if (confirm('Вы уверены, что хотите удалить машину?')) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/cars/delete/${this.carData.id}`);
          this.$emit('carDeleted', this.carData.id);
        } catch (error) {
          console.error('Error deleting car:', error);
        }
      }
    },
  },
};
</script>
