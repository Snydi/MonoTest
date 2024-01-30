import { createRouter, createWebHistory } from 'vue-router';
import Clients from '../views/Clients.vue';
import Cars from '../views/Cars.vue';
import CreateClient from '../views/CreateClient.vue';
import EditClient from '../views/EditClient.vue';
import RegisterForm from '../views/RegisterForm.vue';
import LoginForm from '../views/LoginForm.vue';
import ApiService from '../services/ApiService.js';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
        {
            path: '/register',
            name: 'register',
            component: RegisterForm,
        },
        {
            path: '/login',
            name: 'login',
            component: LoginForm,
        },
        {
            path: '/',
            name: 'index',
            component: Clients,
            beforeEnter: (to, from, next) => {
                ApiService.isAuthenticated() ? next() : next({ name: 'login' });
            },
        },
        {
            path: '/clients',
            name: 'clients',
            component: Clients,
            beforeEnter: (to, from, next) => {
              ApiService.isAuthenticated() ? next() : next({ name: 'login' });
            },
        },
        {
            path: '/clients/create',
            name: 'createClient',
            component: CreateClient,
            beforeEnter: (to, from, next) => {
              ApiService.isAuthenticated() ? next() : next({ name: 'login' });
            },
        },
        {
            path: '/clients/edit/:id',
            name: 'editClient',
            component: EditClient,
            beforeEnter: (to, from, next) => {
              ApiService.isAuthenticated() ? next() : next({ name: 'login' });
            },
        },
        {
            path: '/cars',
            name: 'cars',
            component: Cars,
            beforeEnter: (to, from, next) => {
              ApiService.isAuthenticated() ? next() : next({ name: 'login' });
            },
        },

  ],
});

export default router;
