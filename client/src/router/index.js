import { createRouter, createWebHistory } from 'vue-router'
import Clients from '../views/Clients.vue'
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
      path: '/clients/edit/:id',
      name: 'editClient',
      component: EditClient
    },
  ]
})

export default router
