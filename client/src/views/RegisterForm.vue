<template>
  <h1>Регистрация</h1>
  <router-link to="/login">
    <button class="btn btn-success">Войти</button>
  </router-link>
  <form @submit.prevent="registerUser">
    <div class="form-group">
      <label for="email">Email адрес</label>
      <input v-model="user.email" required type="email" class="form-control" id="email" placeholder="Введите email">
    </div>

    <div class="form-group">
      <label For="password">Пароль</label>
      <input v-model="user.password" required type="password" class="form-control" id="password" placeholder="Введите пароль">
    </div>

    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
  </form>

  <ApiErrorMessage :errors="errors" :showMessage="showApiErrorMessage"/>
  <ApiSuccessMessage :message="message" :showMessage="showApiSuccessMessage" />

</template>


<script>

import ApiService from "../services/ApiService.js";
import ApiErrorMessage from "../components/ApiErrorMessage.vue";
import ApiSuccessMessage from "../components/ApiSuccessMessage.vue";

export default {
  data() {
    return {
      user: {
        email: null,
        password: null,
      },

      message: '',
      showApiSuccessMessage: false,
      showApiErrorMessage: false,
      errors: [],
    };
  },

  methods: {
    async registerUser() {
      const { success, data, error } = await ApiService.makeRequest(
          `register`,
          "post",
          this.user,
          this
      );
      if (success) {
        ApiService.handleSuccessMessage(data.message, this);
      } else {
        ApiService.handleErrorMessage(error, this);
      }
    },
  },
  components: {
    ApiErrorMessage,
    ApiSuccessMessage,
  },
}
</script>

<style scoped>

</style>