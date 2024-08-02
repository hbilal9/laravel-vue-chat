<script setup lang="ts">
import List from '@/components/chat/conversation/List.vue'
</script>

<template>
  <div class="flex gap-2 w-full px-10 h-screen">
    <div class="flex flex-col w-[18rem]">
      <h1 class="text-2xl font-bold">Conversations</h1>
      <p class="text-sm text-gray-500">Click on a conversation to see the messages</p>
      <List />
    </div>
    <div class="flex flex-col grow text-center">
      <h1 class="text-2xl font-bold">Select Conversation To Start Chatting</h1>
      <p class="text-sm text-gray-500">Click on a conversation to see the messages</p>
      <div class="bg-gray-200 rounded h-full w-full mt-4">Hello</div>
    </div>
  </div>
</template>
