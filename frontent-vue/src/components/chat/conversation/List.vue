<script setup lang="ts">
import { onMounted } from 'vue'
import Item from './Item.vue'
import { useConversationStore } from '@/stores/conversationStore'

const store = useConversationStore()

onMounted(() => {
  store.fetchConversations()
})
</script>

<template>
  <ul class="space-y-2 mt-4 grow bg-primary-300 px-2 py-4 rounded">
    <Item
      v-for="conversation in store.conversations"
      :key="conversation.id"
      :conversation="conversation"
      @select-conversation="store.setSelectedConversation($event)"
    />
  </ul>
</template>
