import { http } from '@/services/http'
import type { IUser } from '@/types/user'
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('authStore', () => {
  const user = ref<IUser | null>(null)
  const isLoggedIn = ref<boolean>(false)

  const login = async (data: { email: string; password: string }) => {
    try {
      const response = await http().post('/login', data)
      user.value = response.data.user
      isLoggedIn.value = true
      localStorage.setItem('token', response.data.access_token)
    } catch (error: any) {
      console.log(error)
    }
  }

  return {
    user,
    isLoggedIn,
    login
  }
})
