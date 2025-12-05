<script setup lang="ts">
import router from '@/router'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()

const onLogout = async () => {
  await auth.logout()
  router.push({ name: 'login' })
}
</script>

<template>
  <div class="min-h-screen">
    <nav class="flex justify-between">
      <div>Menu</div>
      <div>
        <button @click="onLogout">Logout</button>
      </div>
    </nav>
    <slot></slot>
  </div>
</template>
