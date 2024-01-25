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

    <button type="submit" class="btn btn-success">Добавить</button>
  </form>

  <ApiErrorMessage :errors="errors" :showMessage="showApiErrorMessage"/>
  <ApiSuccessMessage :message="message" :showMessage="showApiSuccessMessage" />
</template>

<script>

import ApiErrorMessage from "../components/ApiErrorMessage.vue";
import ApiSuccessMessage from "../components/ApiSuccessMessage.vue";
import ApiService from "../services/ApiService.js";

export default {
  props: {
    clientId: {
      type: Number,
      required: true,
    },
  },
 data(){
   return{
     car: {
       brand: "",
       plate: "",
       model: "",
       color: "",
       in_parking: ""
     },
     message: '',
     showApiSuccessMessage: false,
     showApiErrorMessage: false,
     errors: [],
   };
 },

  methods: {
    async createCar() {
      const { success, data, error } = await ApiService.makeRequest(
          `cars/store/${this.clientId}`,
          "post",
          this.car,
          this
      );
      if (success) {
        ApiService.handleSuccessMessage(data.message, this);
      } else {
        ApiService.handleErrorMessage(error, this);
      }
    }
  },
  components: {
    ApiErrorMessage,
    ApiSuccessMessage,
  },
};
</script>
