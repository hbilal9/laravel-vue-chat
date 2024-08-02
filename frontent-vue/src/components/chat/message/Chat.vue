<script setup lang="ts">
import { watch } from 'vue'
import { useConversationStore } from '@/stores/conversationStore'
import { useMessageStore } from '@/stores/messageStore'
import Message from './Message.vue'

const conversationStore = useConversationStore()
const store = useMessageStore()

watch(
  () => conversationStore.selectedConversation,
  (conversation) => {
    console.log(conversation)
    store.fetchMessages(conversation?.id!)
  }
)
</script>

<template>
  <div class="bg-gray-200 rounded h-full w-full mt-4">
    <ul class="flex flex-col gap-2 justify-start px-2 py-2">
      <Message v-for="msg in store.messages" :key="msg.id" :message="msg" />
    </ul>
  </div>
</template>
