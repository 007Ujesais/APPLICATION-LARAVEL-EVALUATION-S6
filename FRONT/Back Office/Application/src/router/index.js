import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Pages/Page.home.vue' // Vérifie le chemin et la casse

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL), // Assure-toi que BASE_URL est bien défini
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
  ],
})

export default router
