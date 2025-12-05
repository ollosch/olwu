import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import type { ApiError } from './lib/http'
import { toast } from 'vue-sonner'

import '@/styles.css'
import { useAuthStore } from './stores/auth'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')

app.config.errorHandler = async (err, instance, info) => {
  const error = err as ApiError

  if (import.meta.env.VITE_APP_DEBUG === 'true') {
    console.error('Global error handler:', err, instance, info)
  }

  if (!error) {
    console.error('Error is empty:', err, instance, info)
  }

  switch (error.type) {
    case 'auth':
      try {
        await useAuthStore().logout()
      } finally {
        toast.error('You are not logged in. Please log in to continue.')
        router.push({ name: 'login' })
      }
      break
    case 'forbidden':
      toast.error('You do not have permission to access this resource.')
      break
    case 'validation':
      // Laravel 422 errors have already been handled in useApi
      break
    case 'network':
      toast.error('Network error. Please check your internet connection.')
      break
  }
}
