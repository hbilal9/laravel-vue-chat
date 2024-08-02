<script setup lang="ts">
import { reactive } from 'vue'
import Button from '@/components/ui/Button.vue'
import TextInput from '@/components/ui/TextInput.vue'
import { useAuthStore } from '@/stores/authStore'

const auth = useAuthStore()

const user = reactive({
  email: 'hbilal@gmail.com',
  password: 'password'
})
</script>

<template>
  <div class="w-full h-full">
    <div class="fixed inset-0 w-full h-full bg-secondary-50">
      <div class="h-full w-auto flex justify-center text-secondary-600">
        <div class="mx-5 sm:mx-0 md:w-full max-w-[30rem]">
          <div class="w-full">
            <div class="p-4 flex flex-col justify-center items-center text-center">
              <!-- <img class="my-20 w-24" src="/images/logo.png" /> -->
              <h1 class="text-3xl sm:text-2xl font-poppins md:text-3xl 2xl:text-3xl font-extrabold">
                Welcome Back!
              </h1>
              <p class="text-gray-500">Enter the email and password you used to register</p>
            </div>
            <div class="text-secondary-700">
              <form>
                <TextInput
                  key="email"
                  v-model="user.email"
                  label="Email"
                  placeholder="Enter Email"
                />
                <TextInput
                  key="password"
                  v-model="user.password"
                  type="password"
                  label="Password"
                  placeholder="Enter Password"
                />
                <small class="text-danger text-xs text-center block">
                  {{ auth.loginErrorMessage }}
                </small>

                <Button @click="auth.login(user)" class="w-full h-12 rounded-lg mt-2">
                  Login
                </Button>
              </form>
              <div class="w-full flex items-center flex-col justify-center mt-8">
                <div>
                  <span>New here?</span>
                  <router-link
                    class="text-sm cursor-pointer select-none font-bold hover:underline"
                    to="/register"
                  >
                    Create an account!
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
