<template>
  <form @submit.prevent="createCar">

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

    <button type="submit" class="btn btn-primary">{{ buttonText }}</button>
  </form>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    car: Object,
    buttonText: String,
  },
  methods: {
    async createCar() {
      try {
        const url =  `http://127.0.0.1:8000/api/cars/update/${this.car.id}`;
        const response = await axios.post(url, this.car);
        console.log(response.data);
      } catch (error) {
        console.error('Error submitting form:', error);
      }
    },
  },
};
</script>
