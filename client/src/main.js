import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import ApiService from './services/ApiService';

ApiService.init();

const app = createApp(App)

app.use(router)

app.mount('#app')
