<template>

    <h1>Клиент</h1>

    <router-link to="/clients/">
      <button type="button" class="btn btn-success">Назад</button>
    </router-link>

    <form @submit.prevent="createClient">
      <div class="form-group">
        <label for="name">ФИО</label>
        <input v-model="client.name" type="text" class="form-control" id="name" placeholder="ФИО:" required>
      </div>

      <select v-model="client.sex" class="custom-select" required>
        <option value="N/A" disabled selected>Укажите пол:</option>
        <option value="male">Мужчина</option>
        <option value="female">Женщина</option>
        <option value="N/A">Предпочитаю не указывать</option>
      </select>

      <div class="form-group">
        <label for="phone">Телефон</label>
        <input v-model="client.phone" type="tel" class="form-control" id="phone" placeholder="Телефон:" required>
      </div>

      <div class="form-group">
        <label for="address">Адрес</label>
        <input v-model="client.address" type="text" class="form-control" id="address" placeholder="Адрес:" required>
      </div>

      <button type="submit" class="btn btn-success">Добавить</button>
    </form>

  <ApiErrorMessage :errors="errors" :showMessage="showApiErrorMessage"/>
  <ApiSuccessMessage :message="message" :showMessage="showApiSuccessMessage" />
</template>

<script>
import ApiService from "../services/ApiService";
import ApiErrorMessage from "../components/ApiErrorMessage.vue";
import ApiSuccessMessage from "../components/ApiSuccessMessage.vue";

export default {
  data() {
    return {
      client: {
        name: "",
        sex: "N/A",
        phone: "",
        address: ""
      },
      message: '',
      showApiSuccessMessage: false,
      showApiErrorMessage: false,
      errors: [],
    };
  },
  methods: {
    async createClient() {
      const { success, data, error } = await ApiService.makeRequest(
          `clients/store`,
          "post",
          this.client,
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
