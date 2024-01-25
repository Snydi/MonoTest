<template>
  <form @submit.prevent="createCar">

    <div class="form-group">
      <label for="brand">Марка</label>
      <div class="autocomplete-container">
        <input
            v-model="car.brand"
            type="text"
            class="form-control"
            id="brand"
            placeholder="Марка:"
            required
            @input="searchBrands"
        />
        <ul v-show="brandSuggestions.length" class="autocomplete-list">
          <li v-for="(suggestion, index) in brandSuggestions" :key="index" @click="selectBrand(suggestion)">
            {{ suggestion.name }}
          </li>
        </ul>
      </div>
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
import _debounce from 'lodash/debounce';

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
     brandSuggestions: [],
   };
 },

  methods: {

    searchBrands: _debounce(async function() {
      const brand = this.car.brand;

      if (brand.length >= 1) {
        const { data } = await ApiService.makeRequest(`car-brands/search/${brand}`, "get");
        this.brandSuggestions = data;
      } else {
        this.brandSuggestions = [];
      }
    }, 300),

    selectBrand(suggestion) {
      this.car.brand = suggestion.name;
      this.brandSuggestions = [];
    },

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

<style>
.autocomplete-container {
  position: relative;
}

.autocomplete-list {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  width: 100%;
  margin-top: 5px;
  padding: 0;
  list-style: none;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.autocomplete-list li {
  padding: 8px 12px;
  cursor: pointer;
}

.autocomplete-list li:hover {
  background-color: #f1f1f1;
}
</style>