import { createRouter, createWebHistory } from 'vue-router'
import authRoutes from '@/router/auth.ts'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [...authRoutes],
})

export default router
