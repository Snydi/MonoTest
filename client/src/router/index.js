import { createRouter, createWebHistory } from 'vue-router'
import Clients from '../views/Clients.vue'
import Cars from '../views/Cars.vue'
import CreateClient from '../views/CreateClient.vue'
import EditClient from '../views/EditClient.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'clients',
      component: Clients
    },
    {
      path: '/clients',
      name: 'clients',
      component: Clients
    },
    {
      path: '/clients/create',
      name: 'createClient',
      component: CreateClient
    },
    {
      path: '/clients/edit/:id',
      name: 'editClient',
      component: EditClient
    },
    {
      path: '/cars',
      name: 'cars',
      component: Cars
    },
  ]
})

export default router
