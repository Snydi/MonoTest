<template>
  <div>
    <h1>Авторизация</h1>
    <router-link to="/register">
      <button class="btn btn-success">Зарегистрироваться</button>
    </router-link>
    <form @submit.prevent="loginUser">
      <div class="form-group">
        <label for="email">Email адрес</label>
        <input v-model="user.email" required type="email" class="form-control" id="email" placeholder="Введите email">
      </div>

      <div class="form-group">
        <label For="password">Пароль</label>
        <input v-model="user.password" required type="password" class="form-control" id="password" placeholder="Введите пароль">
      </div>

      <button type="submit" class="btn btn-primary">Войти</button>
    </form>

    <ApiErrorMessage :errors="errors" :showMessage="showApiErrorMessage"/>
    <ApiSuccessMessage :message="message" :showMessage="showApiSuccessMessage" />
  </div>
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
    async loginUser() {
      const { success, data, error } = await ApiService.makeRequest(
          `login`,
          "post",
          this.user,
          this
      );
      if (success) {
        const apiToken = data.token;
        localStorage.setItem("apiToken", apiToken);
        ApiService.setAuthToken(apiToken);
        ApiService.handleSuccessMessage(data.message, this);
        this.$router.push({ name: 'clients' });
      } else {
        ApiService.handleErrorMessage(error, this);
      }
    },
  },
  components: {
    ApiErrorMessage,
    ApiSuccessMessage,
  },
};
</script>

<style scoped>
</style>
