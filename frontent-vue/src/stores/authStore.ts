import { http } from '@/services/http'
import type { IUser } from '@/types/user'
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('authStore', () => {
  const user = ref<IUser | null>(null)
  const isLoggedIn = ref<boolean>(false)
  const loginErrorMessage = ref<string>('')

  const login = async (data: { email: string; password: string }) => {
    try {
      const response = await http().post('/auth/login', data)
      user.value = response.data.user
      isLoggedIn.value = true
      localStorage.setItem('token', response.data.access_token)
    } catch (error: any) {
      loginErrorMessage.value = error.response.data.message
      console.log(error)
    }
  }

  const getProfile = async () => {
    try {
      const response = await http().get('/auth/me')
      user.value = response.data
    } catch (error: any) {
      console.log(error)
    }
  }

  const changeOnlineStatus = async (status: boolean) => {
    try {
      await http().post('/users/online-status', { status })
    } catch (error: any) {
      console.log(error)
    }
  }

  return {
    user,
    isLoggedIn,
    loginErrorMessage,
    getProfile,
    changeOnlineStatus,
    login
  }
})
