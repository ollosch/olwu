import { createRouter, createWebHistory } from 'vue-router'
import authRoutes from '@/router/auth.ts'
import appRoutes from '@/router/app.ts'
import { useAuthStore } from '@/stores/auth.ts'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [...authRoutes, ...appRoutes],
})

router.beforeEach(async (to) => {
  const auth = useAuthStore()
  const requiresAuth = to.meta.requiresAuth
  const requiresGuest = to.meta.requiresGuest

  if (!auth.user && auth.token) {
    try {
      await auth.fetchUser()
    } catch {
      // Auth failed - clear invalid token to prevent redirect loop
      auth.clear()
    }
  }

  if (requiresAuth && !auth.user) {
    return {
      name: 'login',
      query: { redirect: to.fullPath },
    }
  }

  if (requiresGuest && auth.user) {
    return { name: 'systems' }
  }
})

export default router
