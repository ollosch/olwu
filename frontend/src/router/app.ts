export default [
  {
    path: '/systems',
    name: 'systems',
    meta: { requiresAuth: true },
    component: () => import('@/views/App/SystemListView.vue'),
  },
]
