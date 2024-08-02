<script setup lang="ts">
import type { IMessage } from '@/types/conversation'
import { useAuthStore } from '@/stores/authStore'

const auth = useAuthStore()

defineProps<{
  message: IMessage
}>()
</script>

<template>
  <li
    :class="
      auth.user?.id === message.user_id ? 'self-end bg-primary-200' : 'self-start bg-primary-100'
    "
    class="flex flex-col p-2 rounded min-w-24 max-w-64"
  >
    <span class="">
      {{ message.content }}
    </span>
    <span class="flex gap-1 text-xs self-end"
      >2hrs ago
      <p class="text-green-600">&#x2713;</p></span
    >
  </li>
</template>
