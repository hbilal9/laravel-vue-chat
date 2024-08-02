<script setup lang="ts">
import { watch, ref, onMounted } from 'vue'
import { useConversationStore } from '@/stores/conversationStore'
import { useMessageStore } from '@/stores/messageStore'
import Message from './Message.vue'
import TextInput from '@/components/ui/TextInput.vue'
import echo from '@/services/echo'

const conversationStore = useConversationStore()
const store = useMessageStore()

const message = ref('')

watch(
  () => conversationStore.selectedConversation,
  (conversation) => {
    store.fetchMessages(conversation?.id!)
    echo.join(`conversation.${conversation?.id}`).listen('MessageSent', (e) => {
      store.addMessage(e.message)
    })
  }
)

const handleSendMessage = async () => {
  let data = {
    conversationId: conversationStore.selectedConversation?.id!,
    content: message.value
  }
  await store.sendMessage(data)
  message.value = ''
}
</script>

<template>
  <div class="bg-gray-200 rounded h-full w-full mt-4">
    <ul class="flex flex-col gap-2 grow justify-start px-2 py-2">
      <Message v-for="msg in store.messages" :key="msg.id" :message="msg" />
    </ul>
  </div>
  <div class="flex gap-2">
    <TextInput v-model="message" class="py-4 w-full" placeholder="type here..." />
    <button @click="handleSendMessage" class="bg-blue-500 text-white p-2 rounded h-12 mt-4">
      Send
    </button>
  </div>
</template>
