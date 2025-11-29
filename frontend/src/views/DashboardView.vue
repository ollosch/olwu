<script setup lang="ts">
import AppLayout from './AppLayout.vue'

import { useAuthStore } from '@/stores/auth'
const { user } = useAuthStore()
</script>

<template>
  <AppLayout>
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <p>Welcome to your dashboard {{ user?.name }}!</p>
  </AppLayout>
</template>
