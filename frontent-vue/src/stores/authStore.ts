import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('authStore', () => {
  const user = ref<null>(null)
  const isLoggedIn = ref<boolean>(false)

  return {
    user,
    isLoggedIn
  }
})
