<template>
  <h1>Регистрация</h1>
  <form @submit.prevent="registerUser">
    <div class="form-group">
      <label for="email">Email адрес</label>
      <input v-model="email" type="email" class="form-control" id="email" placeholder="Введите email">
    </div>

    <div class="form-group">
      <label For="password">Пароль</label>
      <input v-model="password" type="password" class="form-control" id="password" placeholder="Введите пароль">
    </div>

    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
  </form>
</template>

<script>
import AuthService from "../services/AuthService.js";
export default {
  data() {
    return {
      email: null,
      password: null,
    };
  },
  methods: {
    registerUser() {
      this.error = null;
      const payload = {
        email: this.email,
        password: this.password,
      };
      AuthService.registerUser(payload)
          .then(() => this.$router.push("/clients"));
    },
  },
}
</script>

<style scoped>

</style>