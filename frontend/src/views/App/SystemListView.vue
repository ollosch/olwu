<script setup lang="ts">
import { ref, onMounted } from 'vue'
import AppLayout from '@/views/App/AppLayout.vue'

import { useApi } from '@/composables/useApi'

interface System {
  id: number
  name: string
  description: string
  created_at: string
  updated_at: string
}

const { get, loading } = useApi()

const systems = ref<System[]>([])

onMounted(async () => {
  systems.value = await get<System[]>('/systems')
})
</script>

<template>
  <AppLayout>
    <div class="p-6">
      <div v-if="loading" class="flex justify-center items-center h-64">
        <div
          class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-16 w-16"
        ></div>
      </div>
      <h1 class="text-2xl font-bold mb-4">Systems List</h1>
      <ul>
        <li
          v-for="system in systems"
          :key="system.id"
          class="mb-4 p-4 border rounded-lg hover:shadow-lg transition-shadow"
        >
          <h2 class="text-xl font-semibold">{{ system.name }}</h2>
          <p class="text-gray-600">{{ system.description }}</p>
        </li>
      </ul>
    </div>
  </AppLayout>
</template>
