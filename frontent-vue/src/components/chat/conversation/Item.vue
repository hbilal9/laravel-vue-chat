<script setup lang="ts">
import {} from 'vue'
import type { IConversation } from '@/types/conversation'

defineProps<{ conversation: IConversation }>()
</script>

<template>
  <li
    @click="$emit('select-conversation', conversation)"
    class="relative px-2 py-3 rounded bg-gray-200 cursor-pointer hover:bg-primary-200"
  >
    <span>{{ conversation?.users?.[0].name }}</span>
    <span
      class="border-white border rounded-full w-3 h-3 absolute top-1/2 transform -translate-y-1/2"
      :class="conversation?.users?.[0].is_online ? 'bg-emerald-500' : 'bg-gray-400'"
    ></span>
  </li>
</template>
