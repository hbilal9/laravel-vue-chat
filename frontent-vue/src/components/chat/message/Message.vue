<script setup lang="ts">
import type { IMessage } from '@/types/conversation'
import { useAuthStore } from '@/stores/authStore'
import { timeAgo } from '@/utils/moment'

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
    <span class="flex gap-1 text-xs self-end">
      {{ timeAgo(message.created_at) }}
      <p
        v-if="auth.user?.id === message.user_id"
        :class="message.seen ? 'text-green-600' : 'text-gray-600'"
      >
        &#x2713;
      </p></span
    >
  </li>
</template>
